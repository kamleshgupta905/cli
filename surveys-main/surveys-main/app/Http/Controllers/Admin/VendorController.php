<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LayoutController;
use App\Models\admin\CommonDataModel;
use App\Models\admin\SerialMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function index()
    {
        $result["vendorList"] = DB::table('vendor')->orderByDesc('id')->get();
        $body['bodyView'] = view('admin/vendor/vendor_list_view', $result);
        return LayoutController::loadAdmin($body);
    }

    public function addEdit($id = "")
    {
        $data = LayoutController::addEditCommon($id, []);
        $data["editData"] = [];

        if ($id > 0) {
            $data["editData"] = DB::table('vendor')->where('id', $id)->first();
        }

        $body['bodyView'] = view('admin/vendor/vendor_add_edit', $data);
        return LayoutController::loadAdmin($body);
    }

    public function addEditAction(Request $request)
    {
        $mode = $request->post('mode');
        $name = $request->post('name');
        $email = $request->post('email');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return response()->json(['msg_status' => 0, 'errors' => $error]);
        } else {
            if ($mode == "Add") {
                $dataArray = [
                    'vendor_id' => SerialMaster::generateSerialNumber('VENDOR'),
                    'name' => $name,
                    'email' => $email,
                    'date' => now()
                ];

                $insertId = CommonDataModel::insertSingleTableData('vendor', $dataArray);
                return response()->json(['msg_status' => 1, 'data' => $insertId]);
            } else {
                $id = $request->post('id');
                $dataArray = [
                    'name' => $name,
                    'email' => $email,
                    'date' => now()
                ];

                CommonDataModel::UpdateSingleTableData('vendor', $dataArray, ['id' => $id], $id);
                return response()->json(['msg_status' => 1, 'data' => $id]);
            }
        }
    }

    public function view($id)
    {
        $result["vendorData"] = DB::table('vendor')->where('id', $id)->first();
        $body['bodyView'] = view('admin/vendor/vendor_view', $result);
        return LayoutController::loadAdmin($body);
    }

    public function status(Request $request)
    {
        $id = $request->post('id');
        $status = DB::table('vendor')->where(['id' => $id])->first();
        $updatedStatus = $status->is_active == "Y" ? "N" : "Y";

        CommonDataModel::UpdateSingleTableData('vendor', ['is_active' => $updatedStatus], ['id' => $id], $id);
        return response()->json(['success' => true, 'status' => $updatedStatus, 'message' => 'Status updated successfully']);
    }
}
