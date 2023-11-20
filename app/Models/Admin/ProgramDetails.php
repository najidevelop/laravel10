<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class ProgramDetails extends Model
{
    use HasFactory;
  public int $id ;
    public string $programName ;
    public string $ersionName ;      
    public string $serial ;
    public string $customerDeviceCode ;
    public Carbon $expireDate;
    public Carbon $activateDate ;
    public string $packageNumber ;
    public Carbon $updateDate;
    public bool $isLimitDate;

    public bool $isActive;
    public string $customerName;
    public string $customerLastName;
    public string $agentName;
    public string $agentLastName;
    public string $agentAccountName;
    public string $notes;
}
