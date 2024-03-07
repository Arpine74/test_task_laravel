<?php

namespace App\Models;

use App\Traits\FilterableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FilterableTrait;

    public const STATUS_READY_TO_START = 'Ready To Start';
    public const STATUS_IN_PROGRESS = 'In Progress';
    public const STATUS_REVIEW = 'Review';
    public const STATUS_READY_TO_DEPLOY = 'Ready To Deploy';
    public const STATUS_COMPLETED = 'Completed';

    public const AVAILABLE_STATUSES = [
        self::STATUS_READY_TO_START,
        self::STATUS_IN_PROGRESS,
        self::STATUS_REVIEW,
        self::STATUS_READY_TO_DEPLOY,
        self::STATUS_COMPLETED,
    ];

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'status',
    ];
}
