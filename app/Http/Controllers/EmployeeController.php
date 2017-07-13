<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Image;
use Alert;
use App\Model\User;
use App\Model\Review;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as input;
use App\Http\Controllers\Controller;
use Charts;
use Redirect;

class EmployeeController extends Controller
{
    public function showProfile()
    {
        return view('emp.profile');
    }

    public function showReport(Request $request){
      $count = Review::where('user_id', Auth::user()->id)->pluck('rating')->count();
      $avg = Review::where('user_id', Auth::user()->id)->pluck('rating')->avg();
      $five = Review::where('user_id', Auth::user()->id)->where('rating', 5)->count();
      $four = Review::where('user_id', Auth::user()->id)->where('rating', 4)->count();
      $three = Review::where('user_id', Auth::user()->id)->where('rating', 3)->count();
      $two = Review::where('user_id', Auth::user()->id)->where('rating', 2)->count();
      $one = Review::where('user_id', Auth::user()->id)->where('rating', 1)->count();

      $chart = Charts::multi('bar', 'material')
            // Setup the chart settings
            ->title("My Chart")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(100, 300) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            ->loader(true)->loaderColor('#FFC107')
            ->responsive(true)
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107', '#2196F3', '#F44336'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('People', [$five, $four, $three, $two, $one])
            // Setup what the values mean
            ->labels(['Very good (5)', 'Good (4)', 'Okay (3)', 'Poor (2)', 'Very poor (1)']);

            $reviews = Review::where('user_id', Auth::user()->id )->where('comment', '!=', '')->paginate(2);
            // dd($reviews);
            $html='';
            foreach ($reviews as $review) {
                $html.='<li>'.$review->id.' <strong>'.$review->comment.'</strong> </li>';
            }
            if ($request->ajax()) {
                return $html;
            }

      return view('emp.report', compact('count', 'avg', 'chart', 'reviews'));
    }

    public function showEvaluate($id)
    {
      $isDuplicated = (bool)Review::where('reviewer_id', Auth::user()->id)->where('user_id', $id)->first();
      if ($isDuplicated){
        Alert::info('Your review has been already exist!', 'Information');
        return redirect('/evaluate');
      } else {
        $user = User::find($id);
        return view('emp.evaluate', compact('user'));
      }
    }
    public function showEvaluateAll()
    {
      $users = User::where('id', '!=', Auth::user()->id)->get();
      $reviews = Review::where('reviewer_id', Auth::user()->id )->get();

      return view('emp.allevaluate', compact('users','reviews'));
    }

    public function showChangeUsername()
    {
      return view('emp.changeusername');
    }

    public function showChangePw()
    {
        return view('emp.changepw');
    }

    public function evaluate(Request $request)
    {
        // dd($request->all());
        $review              = new Review();new Review();
        $review->user_id     = $request->userId;
        $review->reviewer_id = $request->reviewerId;
        $review->rating      = $request->rating;
        $review->comment     = $request->comment;
        $review->save();
        Alert::success('Your review has been submitted!', 'Successfully!');
        return redirect('/evaluate');
    }

    public function changeUsername(Request $request)
    {
        $inputPw           = $request->confirmpassword;
        $pw             = User::where('id', Auth::user()->id)->value('password');
        if (Hash::check($inputPw, $pw)) {
            $emp           = User::findOrFail(Auth::user()->id);
            $emp->username = $request->username;
            $emp->save();
            Alert::success('Your password has been updated!', 'Successfully!');
            return redirect('/profile');
        } else {
            Alert::error('The specified password do not match!', 'Oops!');
            return redirect('/changeusername');
        }
    }

    public function changePw(Request $request)
    {
        $inputPw           = $request->oldpassword;
        $oldPw             = User::where('id', Auth::user()->id)->value('password');
        if (Hash::check($inputPw, $oldPw)) {
            $this->validate($request, [
              'password'   => 'required|min:6|confirmed',
            ]);
            $emp           = User::findOrFail(Auth::user()->id);
            $emp->password = bcrypt($request->password);
            $emp->save();
            Alert::success('Your password has been updated!', 'Successfully!');
            return redirect('/profile');
        } else {
            Alert::error('The specified password do not match!', 'Oops!');
            return redirect('/changepw');
        }
    }

    public function update_photo(Request $request)
    {
        $rules           = array(
          'photo'        => 'image'
        );
        $validator       = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('profile')
                    ->withErrors($validator)
                    ->withInput();
        } elseif ($request->hasFile('photo')) {
            $photo       = $request->file('photo');
            $filename    = time() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(300, 300)->save(public_path('/img/uploads/' . $filename));

            $user        = Auth::user();
            $user->photo = $filename;
            $user->save();
            Alert::success('Your photo has been updated!', 'Successfully!');
        }
        return view('emp.profile');
    }

}
