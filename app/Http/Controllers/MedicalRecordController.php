<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MedicalRecordService;
use App\Http\Requests\CreateMedicalRecordRequest;

class MedicalRecordController extends Controller
{
    public function __construct(private readonly MedicalRecordService $medicalRecordService)
    {
    }

    public function saveMedicalRecord(CreateMedicalRecordRequest $request)
    {
        return $this->medicalRecordService->saveMedicalRecord($request);
    }

    public function getMedicalRecord()
    {
        return $this->medicalRecordService->getMedicalRecord();
    }
}
