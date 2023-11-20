<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\RoomNumber;
use App\Models\RoomType;
use App\Models\BookArea;
use App\Models\MultiImage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;


class RoomTypeController extends Controller
{
    //
    public function RoomTypeList()
    {
        $allData = RoomType::orderBy('id','desc')->get();
        return view('backend.allroom.roomtype.view_roomtype',compact('allData'));
    }// End Method

    public function AddRoomType()
    {
        return view('backend.allroom.roomtype.add_roomtype');
    }// End Method



    public function RoomTypeStore(Request $request)
    {
        $roomtype_id = RoomType::insertGetId([
           'name' => $request->name,
           'created_at' => Carbon::now(),
        ]);

        Room::insert([
            'roomtype_id' => $roomtype_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'RoomType  Inserted Successfully',
            'alert-type'=> 'success'
        );

        return redirect()->route('room.type.list')->with($notification);
    }// End Method

    public function EditRoomType()
    {
        return view('backend.allroom.roomtype.add_roomtype');
    }// End Method

    public function DeleteRoomType()
    {
        return view('backend.allroom.roomtype.add_roomtype');
    }// End Method

    public function DeleteRoom(Request $request, $id)
    {
        $room = Room::find($id);

        if(file_exists('upload/roomimg/'.$room->image) AND ! empty($room->image)) {
            @unlink('upload/roomimg/'.$room->image);
        }

        $subimage = MultiImage::where('room_id',$room->id)->get()->toArray();
        if (!empty($subimage)) {
            foreach ($subimage as $value) {
                if (!empty($value)) {
                    @unlink('upload/roomimg/multi_img/'.$value['multi_img']);
                }
            }
        }
        RoomType::where('id',$room->roomtype_id)->delete();
        MultiImage::where('room_id',$room->id)->delete();
        Facility::where('room_id',$room->id)->delete();
        RoomNumber::where('room_id',$room->id)->delete();
        $room->delte();
        $notification = array(
            'message' => 'Room  Delteded Successfully',
            'alert-type'=> 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method

}
