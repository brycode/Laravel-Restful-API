<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\Meetingdetail;
use App\User;

class MeetingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $meetings = Meetingdetail::all();


      if(count($meetings)>0){
          $response =[
              'msg' => 'Success find all Meeting Participant',
              'data' => $meetings
          ];
          return response()->json($response,201);
      }
          //NOTFOUND
          $response =[
              'msg' => 'Participant not found'
          ];
          return response()->json($response,404);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
            'meeting_id'        =>'required',
            'user_id'           =>'required'
      ]);

        $meeting_id = $request->input('meeting_id');
        $user_id = $request->input('user_id');

        $meeting = new Meetingdetail;
        $meeting->meeting_id = $meeting_id;
        $meeting->user_id = $user_id;

        if($meeting->save()){
          $response = [
            'msg' => 'Participant Has Been Added',
            'data' => $meeting
          ];
          return response()->json($response,201);
        }
          $response = [
            'msg' => 'Failed to Add new Participant'
          ];
          return response()->json($response,404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $meeting = Meetingdetail::with('user')->with('meeting')->where('meeting_id',$id)->get();
      if(count($meeting)>0){
          $response =[
              'msg' => 'Success find Meeting Data',
              'data' => $meeting
          ];
          return response()->json($response,201);
      }
          //NOTFOUND
          $response =[
              'msg' => 'Data not found'
          ];
          return response()->json($response,404);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $meeting = Meetingdetail::findOrFail($id);

      if($meeting->delete()){
        $response = [
          'msg' => 'Meeting Participant Has Been Deleted',
          'data' => $meeting
        ];
        return response()->json($response,201);
      }
        $response = [
          'msg' => 'Failed to Delete Meeting Participant'
        ];
        return response()->json($response,404);
    }
}
