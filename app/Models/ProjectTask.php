<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int|null $project_id
 * @property string $title
 * @property int $priority
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project|null $project
 * @method static \Database\Factories\ProjectTaskFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProjectTask extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'title', 'priority'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
