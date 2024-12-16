<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Tasks</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="apple-touch-icon" href="apple-touch-icon.png" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script src="{{ asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <nav class="nav">
        <div class="burger">
            <div class="burger__patty"></div>
        </div>
        <ul class="nav__list">
            <li class="nav__item">
                <a href="/home" class="nav__link c-blue"><img src="img/home-icon.png" alt="" /></a>
            </li>
            @auth
                <li class="nav__item">
                    <a href="/tasks" class="nav__link c-yellow scrolly"><img src="img/about-icon.png" alt="" /></a>
                </li>
                <li class="nav__item">
                    <a href="/projects" class="nav__link c-red"><img src="img/projects-icon.jpg" alt="" /></a>
                </li>
            @endauth
            <li class="nav__item">
                <a href="/contacts" class="nav__link c-green"><img src="img/contact-icon.png" alt="" /></a>
            </li>
        </ul>
    </nav>

    <section class="panel b-yellow" id="2">
        <article class="panel__wrapper">
            <div class="panel__content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="about-content">

                                <div class="heading d-flex justify-content-between align-items-center">
                                    <h4>Tasks</h4>
                                    <button id="show-task-form" class="btn btn-primary" data-toggle="modal" data-target="#taskAddModal">Add Task</button>
                                </div>

                                <div class="modal fade" id="taskAddModal" tabindex="-1" role="dialog" aria-labelledby="taskAddModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="taskAddModalLabel">Add Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                             </button>
                        </div>
                        <div class="modal-body">
                            <form id="add-task-form" action="{{ route('tasks.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="task-title">Title</label>
                                    <input type="text" id="task-title" name="title" class="form-control" placeholder="Task Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="task-status">Status</label>
                                    <select id="task-status" name="status" class="form-control" required>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Not started">Not started</option>
                                        <option value="Started">Started</option>
                                        <option value="Finished">Finished</option>
                                        <option value="Checked">Checked</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="task-start-time">Start Time</label>
                                    <input type="datetime-local" id="task-start-time" name="start_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="task-end-time">End Time</label>
                                    <input type="datetime-local" id="task-end-time" name="end_time" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="task-user">Assigned User</label>
                                    <select id="task-user" name="user_id" class="form-control" required>
                                        <option value="" disabled selected>Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="task-project">Project</label>
                                    <select id="task-project" name="project_id" class="form-control" required>
                                        <option value="" disabled selected>Select Project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="task-description">Description</label>
                                    <textarea id="task-description" name="description" class="form-control" rows="3" placeholder="Task Description" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                                <div class="row mt-4">
                                    @foreach (['not_started', 'started', 'finished', 'checked'] as $status)
                                        <div class="col-md-3">
                                            <div class="task-container">
                                                <h5>{{ ucfirst(str_replace('_', ' ', $status)) }}</h5>
                                                <div class="task-box">
                                                    @foreach ($tasks[$status] as $task)
                                                    <div class="task-preview">
                                                        <div class="d-flex justify-content-between align-items-center mt-2"></div>
                                                        <h5 class="mb-2">{{ $task->title }}</h5>
                                                        <p class="mb-2 text-muted">
                                                            {{ \Illuminate\Support\Str::limit($task->description, 100, '...') }}
                                                        </p>
                                                        <small>Assigned to: {{ $task->user->name ?? 'Unassigned' }}</small>
                                                            <small>Start: {{ \Carbon\Carbon::parse($task->start_time)->format('d M Y, H:i') }}</small>
                                                            <small>End: {{ \Carbon\Carbon::parse($task->end_time)->format('d M Y, H:i') }}</small>

                                                            <button
                                                                class="btn btn-link text-white"
                                                                data-toggle="modal"
                                                                data-target="#taskModal"
                                                                data-id="{{ $task->id }}"
                                                                data-title="{{ $task->title }}"
                                                                data-description="{{ $task->description }}"
                                                                data-status="{{ $task->status }}"
                                                                data-start_time="{{ $task->start_time }}"
                                                                data-end_time="{{ $task->end_time }}">
                                                                {{ $task->title }}
                                                            </button>
                                                            <button
                                                                class="btn btn-delete btn-sm"
                                                                onclick="confirmDeletion({{ $task->id }})">
                                                                Delete
                                                            </button>
                                                            <form id="delete-task-{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <div class="task-comments">
                                            <h6>Comments</h6>
                                            <ul class="list-group">
                                                @foreach ($task->comments as $comment)
                                                    <li class="list-group-item">
                                                        <strong>{{ $comment->user->name }}</strong> ({{ $comment->created_at->format('d M Y, H:i') }}):
                                                        <p>{{ $comment->content }}</p>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            @auth
                                            <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
                                                @csrf
                                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                <textarea name="content" class="form-control" rows="2" placeholder="Add a comment..." required></textarea>
                                                <button type="submit" class="btn btn-primary btn-sm mt-2">Post Comment</button>
                                            </form>
                                            @endauth
                                        </div>

                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">View Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="taskForm" action="{{ route('tasks.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="task_id" name="task_id">

                        <div class="form-group">
                            <label for="task_title">Title</label>
                            <input type="text" class="form-control" id="task_title" name="title" required>
                        </div>

                        <div class="form-group">
                        <label for="task_description">Description</label>
                        <textarea class="form-control" id="task_description" name="description" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="task_status">Status</label>
                            <select class="form-control" id="task_status" name="status" required>
                                <option value="Not started">Not started</option>
                                <option value="Started">Started</option>
                                <option value="Finished">Finished</option>
                                <option value="Checked">Checked</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="task_start_time">Start Time</label>
                            <input type="datetime-local" class="form-control" id="task_start_time" name="start_time">
                        </div>

                        <div class="form-group">
                            <label for="task_end_time">End Time</label>
                            <input type="datetime-local" class="form-control" id="task_end_time" name="end_time"    >
                        </div>

                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        document.getElementById("show-task-form").addEventListener("click", function () {
            const form = document.getElementById("add-task-form");
            form.style.display = form.style.display === "none" || form.style.display === "" ? "block" : "none";
        });

        $('#taskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var taskId = button.data('id');
            var taskTitle = button.data('title');
            var taskDescription = button.data('description');
            var taskStatus = button.data('status');
            var taskStartTime = button.data('start_time');
            var taskEndTime = button.data('end_time');

            var modal = $(this);
            modal.find('#task_id').val(taskId);
            modal.find('#task_title').val(taskTitle);
            modal.find('#task_description').val(taskDescription);
            modal.find('#task_status').val(taskStatus);
            modal.find('#task_start_time').val(taskStartTime);
            modal.find('#task_end_time').val(taskEndTime);
        });

        function confirmDeletion(taskId) {
            if (confirm('Are you sure you want to delete this task?')) {
                document.getElementById('delete-task-' + taskId).submit();
            }
        }
    </script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
