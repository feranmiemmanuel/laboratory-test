<?php

namespace App\Http\Services;

use App\Models\MedicalRecord;
use App\Events\SendEmailEvent;
use App\Http\Traits\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MedicalRecordService
{
    use JsonResponse;

    public function saveMedicalRecord($request)
    {
        $medicalRecord = new MedicalRecord();
        $medicalRecord->user_id = Auth::id();
        $medicalRecord->x_ray = $request->x_ray;
        $medicalRecord->ultrasound_scan = $request->ultrasound_scan;
        $medicalRecord->ct_scan = $request->ct_scan;
        $medicalRecord->mri = $request->mri;
        $medicalRecord->save();

        $details = [
            'email' => 'peopleoperations@kompletecare.com',
            'content' => [
                'x_ray' => $request->x_ray,
                'ultrasound_scan' => $request->ultrasound_scan,
                'ct_scan' => $request->ct_scan,
                'mri' => $request->mri,
                'date' => now(),
            ],
            'name' => Auth::user()->name,
            'subject' => Auth::user()->name . " medical data",
            'template' => 'medical-record',
            'title' => Auth::user()->name . " medical data",
        ];
        event(new SendEmailEvent($details));

        return $this->successResponse($medicalRecord, 'Data saved successfully');
    }

    public function getMedicalRecord()
    {
        $medicalRecord = MedicalRecord::where('user_id', Auth::id())->get();
        return $this->successResponse($medicalRecord, 'Data fetched successfully');
    }
}