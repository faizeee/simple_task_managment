<x-app-layout>
    @php
    /**
    * @var \App\Models\Project[] $projects
    * @var \App\Models\ProjectTask[] | \Illuminate\Pagination\Paginator $tasks;
    * @var \App\Models\Project $project;
    * */
    @endphp

    <div class="row mb-3">
        <div class="col">
            <div class="d-flex justify-content-between">
                <div class="form-group">
                    <label class="form-label d-none" for="project-filter">Filter By Project</label>
                    <select id="project-filter" class="form-select form-control-sm" onchange="projectChanged()">
                        <option value="">All Projects</option>
                        @foreach($projects ?? [] as $project_option)
                            <option value="{{$project_option->id}}" @selected($project?->id == $project_option->id)>
                                {{$project_option->title}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <a href="{{route('task.create.show')}}" class="btn btn-success"> Create New Task</a>
            </div>
        </div>
    </div>

    @if (session('status'))
        <div class="my-3 font-medium alert alert-{{session('status-type') ?? 'success'}}">
            {!! session('status')  !!}
        </div>
    @endif
    <div class="row">
        <div class="col-12 sortable-list">
            <ul class="list-group" id="sortable">
                @forelse($tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        data-id="{{$task->id}}">
                        <div>
                           {{$task->priority}} - {{$task->title}} - {{$task->created_at->toDayDateTimeString()}}
                            <span class="badge bg-primary rounded-pill">{{$task->project?->title ?? "N/A"}}</span>
                        </div>
                        <span><a href="{{route('task.update.show',$task->id)}}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            <a href="{{route('task.delete',$task->id)}}" class="btn btn-sm btn-danger"
                               onclick="return confirm('Do Really Want To Delete?')" >
                                Delete
                            </a></span>
                    </li>
                @empty
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        No Data
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
    @push('inline-js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
        <script>

            function projectChanged(){
                let project_id = event.currentTarget.value;
                window.location = `/${project_id}`
            }

            var sorted_items = {start:null,end:null};

            document.addEventListener('DOMContentLoaded', function () {
                var el = document.getElementById('sortable');
                var sortable = Sortable.create(el, {
                    animation: 150,
                    onEnd: function (evt) {
                        let task = $(evt.item).data('id');
                        let target_pos = evt.newIndex > evt.oldIndex
                            ? $(el.children[evt.newIndex - 1]).data('id')
                            : $(el.children[evt.newIndex + 1]).data('id');
                        axios.post('{{route('task.updatePriority')}}',{task,target_pos}).then((res)=>{
                            console.log(res);
                        })
                    }
                });
            });

        </script>
    @endpush
</x-app-layout>
