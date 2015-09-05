<?php
namespace App\Http\Controllers;
use Auth;
class NotificationsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of notifications
     *
     * @return Response
     */
    public function index()
    {       
        //找到现在用户的一个user的有很多通知
        $notifications = Auth::user()->notifications();
        //turn 0
        Auth::user()->notification_count = 0;
        Auth::user()->save();
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Remove the specified notification from storage.
     *
     * @param  int  $id
     * @return Response
     */
    //wait to add
    public function destroy($id)
    {
        Notification::destroy($id);
        return Redirect::route('notifications.index');
    }

    public function count()
    {
        return Auth::user()->notification_count;
    }
}
