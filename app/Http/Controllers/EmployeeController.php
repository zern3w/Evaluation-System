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

class EmployeeController extends Controller
{
    public function showProfile(Request $request)
    {
          $reviews=Review::where('user_id', Auth::user()->id )->paginate(2);
          $html='';
          foreach ($reviews as $review) {
              $html.='<li>'.$review->id.' <strong>'.$review->comment.'</strong> </li>';
          }
          if ($request->ajax()) {
              return $html;
          }
        // $reviews=Review::where('user_id', Auth::user()->id )->get();
        return view('emp.profile', compact('reviews'));
    }
    public function showEvaluate($id)
    {
        $user = User::find($id);
        return view('emp.evaluate', compact('user'));
    }
    public function showEvaluateAll()
    {
      $users = User::get();
      $reviews=Review::where('reviewer_id', Auth::user()->id )->get();
      // dd($reviews);
      return view('emp.Allevaluate', compact('users','reviews'));
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
            Image::make($photo)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));

            $user        = Auth::user();
            $user->photo = $filename;
            $user->save();
            Alert::success('Your photo has been updated!', 'Successfully!');
        }
        return view('emp.profile');
    }
      //   public function loadMore(Request $request){
      //    $reviews=Review::paginate(4);
      //    $html='';
      //    foreach ($reviews as $review) {
      //        $html.='<li>'.$review->id.' <strong>'.$review->comment.'</strong> </li>';
      //    }
      //    if ($request->ajax()) {
      //        return $html;
      //    }
      //    return view('emp.profile',compact('reviews'));
      //  }
}
