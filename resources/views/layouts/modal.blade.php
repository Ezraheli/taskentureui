{{-- 
 ==========================================================
 ||                Main Layout for the Modals            ||
 ==========================================================
 
 Description: 
 This is the main reusable modal for the Web Application if
 there are any modals to be use.

 
--}}

{{-- Modal for Editing --}}

@foreach ($tasks as $task)   
<!-- Modal -->
<div
    class="modal fade"
    id="editModalId{{$task->id}}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-light" id="modalTitleId">
                    Edit Task
                </h4>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form action="{{route('tasks.edit', $task->id)}}" method="post">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="" class="form-label">Task Name</label>
                            <input
                                type="text"
                                class="form-control form-control-md border border-2 border-dark-subtle"
                                name="taskname"
                                id="taskname"
                                aria-describedby="helpId"
                                placeholder=""
                                value="{{$task->taskname}}" 
                            />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control form-control-md border border-2 border-dark-subtle" name="description" id="description" rows="3">{{$task->description}}</textarea>
                        </div>
                        {{-- Priorities --}}
                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <select
                                class="form-select form-select-lg"
                                name="priority_id"
                                id="priority_id"
                            >
                                <option value="" selected>Select one</option>
                                <option value="1" {{ $task->priority_id == 1 ? 'selected' : '' }}>High</option>
                                <option value="2" {{ $task->priority_id == 2 ? 'selected' : '' }}>Medium</option>
                                <option value="3" {{ $task->priority_id == 3 ? 'selected' : '' }}>Low</option>
                            </select>
                        </div>
                        {{-- Categories --}}
                        <div class="mb-3">
                            <label for="priority" class="form-label">Category</label>
                            <select
                                class="form-select form-select-lg"
                                name="category_id"
                                id="category_id"
                            >
                                <option value="" selected>Select one</option>
                                <option value="1" {{ $task->category_id == 1 ? 'selected' : '' }}>Personal</option>
                                <option value="2" {{ $task->category_id == 2 ? 'selected' : '' }}>Professional</option>
                                <option value="3" {{ $task->category_id == 3 ? 'selected' : '' }}>Academics</option>
                            </select>
                        </div>

                        {{-- Due Date --}}
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" id="due_date" name="due_date" class="form-control" value="{{ $task->due_date }}">
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn text-light fw-semibold close"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn text-light fw-semibold save">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>


@endforeach


{{-- Modal for the profile --}}
<!-- Modal -->
<div
    class="modal fade"
    id="profileModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-light" id="modalTitleId">
                    Profile
                </h4>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                {{-- Content of the Profile --}}
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="d-flex justify-content-center align-items-start gap-3 w-100">
                                <a href="" data-bs-toggle="modal" data-bs-target="#profileModal">
                                    <img src="{{ asset(Auth::user()->avatar ?? 'images/avatars/level1.png') }}" alt="Avatar" class="avatar img-fluid text-center my-2" 
                                         style="
                                         width: 150px; /* Increased size */
                                         height: 150px; /* Increased size */
                                         border: 3px solid #fff; /* White border */
                                         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); /* Subtle shadow */
                                         object-fit: cover; /* Ensures the image covers the area */
                                         ">
                                </a>
            
                                <div class="d-flex flex-column my-2 text-dark" style="flex: 1;"> <!-- Make this container flexible -->
                                    <h3 class="fw-bold mb-0">{{ Auth::user()->name }}</h3> <!-- Center the text -->
                                    <span class="small">{{ Auth::user()->email }}</span> <!-- Center the text -->
            
                                    <div class="mt-3">
                                        <p class="fw-bold">Level: <span class="fw-light">{{ Auth::user()->level }}</span></p>
                                        <p class="fw-bold">XP: <span class="fw-light">{{ Auth::user()->xp }}</span></p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-12 bg-secondary-subtle rounded-2">
                            {{-- Filter Buttons Container --}}
                            <div class="d-flex row justify-content-center">
                                <div class="btn-group mb-3 mx-0 px-0" role="group" aria-label="Basic example" id="rewardBtnContainer">
                                    <button type="button" class="btn btn-outline-warning active" id="avatarBtn" onclick="filterItems('avatars')">Avatars</button>
                                    <button type="button" class="btn btn-outline-warning" id="badgeBtn" onclick="filterItems('badges')">Badges</button>
                                </div>
                            </div>

                            {{-- Avatars and Badges --}}
                            <div class="row" id="itemsContainer">
                                {{-- Avatars --}}
                                @foreach (Auth::user()->avatars->chunk(ceil(Auth::user()->avatars->count() / 3)) as $chunk)
                                    @foreach ($chunk as $avatars)
                                    <div class="col-6 col-md-4 item avatars">
                                        <div class="card mb-3 shadow-sm">
                                            <img src="{{ asset($avatars->image) }}" alt="Avatar Image" class="img-fluid text-center my-2">
                                            
                                            <div class="card-body">
                                                <h5 class="card-title">{{$avatars->name}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endforeach

                                {{-- Badges --}}
                                @foreach (Auth::user()->badges->chunk(ceil(Auth::user()->badges->count() / 3)) as $chunk)
                                    @foreach ($chunk as $badge)
                                    <div class="col-6 col-md-4 item badges" style="display: none">
                                        <div class="card mb-3 shadow-sm">
                                            <img src="{{ asset($badge->image) }}" alt="Badge Image" class="img-fluid text-center my-2">
                                            
                                            <div class="card-body">
                                                <h5 class="card-title">{{$badge->name}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endforeach
                            </div>        
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                        type="button"
                        class="btn text-light fw-semibold close"
                        data-bs-dismiss="modal"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    // Filterable Buttons in profile
    function filterItems(category) {
        const items = document.querySelectorAll('.item');
        const avatarBtn = document.getElementById('avatarBtn');
        const badgeBtn = document.getElementById('badgeBtn');

        //We Remove the active class
        avatarBtn.classList.remove('active');
        badgeBtn.classList.remove('active');

        // We add it back if we click a button
        if (category === 'avatars') {
            avatarBtn.classList.add('active');
        } else if(category === 'badges') {
            badgeBtn.classList.add('active');
        }

        items.forEach(item => {
            if (item.classList.contains(category)) {
                item.style.display = 'block'; // Show specific category items
            } else {
                item.style.display = 'none'; // Hide other items
            }
        });
    }

    // Initialize the display to show avatars first when page is loaded
    document.addEventListener('DOMContentLoaded', function(){
        filterItems('avatars');
    })
</script>