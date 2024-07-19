<x-app-layout>
    @php
        /**
        * @var \App\Models\Project[] $projects
        * @var \App\Models\ProjectTask $task;
        * */
    @endphp

    <div class="row mb-3">
        <div class="col">
            <div class="d-flex justify-content-between">
                <h3>Update Task: {{$task->title}}</h3>
                <a href="{{route('home')}}" class="btn btn-success">Go Back</a>
            </div>
        </div>
    </div>
    @if (session('status'))
        <div class="my-3 font-medium alert alert-{{session('status-type') ?? 'success'}}">
            {!! session('status')  !!}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form" action="{{route('task.update',$task->id)}}" method="post">
                        @csrf()
                        <div class="row">
                            <div class="col-12">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input class="form-control @error('title') invalid-feedback @enderror"
                                       name="title" id="title" type="text"
                                       required placeholder="Enter Title"
                                       value="{{$task->title}}"
                                >
                                @error('title')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="row my-3">
                            <div class="col-6">
                                <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                                <input class="form-control @error('priority') invalid-feedback @enderror" id="priority" name="priority"
                                       type="number" min="1" required placeholder="Enter Priority"  value="{{$task->priority}}">
                                @error('priority')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="project_id" class="form-label">Project <span class="text-danger">*</span></label>
                                <select name="project_id" class="form-control form-select @error('project_id') invalid-feedback @enderror" id="project_id" required>
                                    <option value="">Select Project</option>
                                    @foreach($projects ?? [] as $project_option)
                                        <option value="{{$project_option->id}}"  @selected($project_option->id == $task->project_id)>
                                            {{$project_option->title}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" name="submit" value="Update" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
