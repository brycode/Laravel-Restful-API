<?php

namespace App\Http\Controllers\API\v1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\Meetingdetail;
use App\User;
class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $meetings = Meeting::all();


      if(count($meetings)>0){
          $response =[
              'msg' => 'Success find all Meeting Data',
              'data' => $meetings
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
            'user_id'           =>'required',
            'title'             =>'required|min:5|max:225',
            'description'       =>'required|min:5|max:225',
            'meeting_datetime'  =>'required'
      ]);

        $user_id = $request->input('user_id');
        $title = $request->input('title');
        $description = $request->input('description');
        $meeting_datetime = $request->input('meeting_datetime');

        $meeting = new Meeting;
        $meeting->user_id = $user_id;
        $meeting->title = $title;
        $meeting->description = $description;
        $meeting->meeting_datetime = $meeting_datetime;

        if($meeting->save()){
          $response = [
            'msg' => 'Meeting Has Been Created',
            'data' => $meeting
          ];
          return response()->json($response,201);
        }
          $response = [
            'msg' => 'Failed to Create new Meeting'
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
        $meeting = Meeting::with('user')->findOrFail($id);
        if(count($meeting)>0){
            $response =[
                'msg' => 'Success find all Meeting Data',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
            'user_id'           =>'required',
            'title'             =>'required|min:5|max:225',
            'description'       =>'required|min:5|max:225',
            'meeting_datetime'  =>'required'
      ]);

      $user_id = $request->input('user_id');
      $title = $request->input('title');
      $description = $request->input('description');
      $meeting_datetime = $request->input('meeting_datetime');

      $meeting = Meeting::findOrFail($id);
      $meeting->user_id = $user_id;
      $meeting->title = $title;
      $meeting->description = $description;
      $meeting->meeting_datetime = $meeting_datetime;

      if($meeting->save()){
        $response = [
          'msg' => 'Meeting Has Been Edited',
          'data' => $meeting
        ];
        return response()->json($response,201);
      }
        $response = [
          'msg' => 'Failed to Edit Meeting Data'
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
      $meeting = Meeting::findOrFail($id);

      if($meeting->delete()){
        $response = [
          'msg' => 'Meeting Has Been Deleted',
          'data' => $meeting
        ];
        return response()->json($response,201);
      }
        $response = [
          'msg' => 'Failed to Delete Meeting Data'
        ];
        return response()->json($response,404);
    }
}
