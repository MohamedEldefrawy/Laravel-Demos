<div class="modal fade" id="editModal{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$comment->user->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('comment.update',['id'=>$comment->id])}}" class="form-control d-flex flex-column"
                      method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="UserId" class="form-label">
                            Comment Creator
                            <select name="userId" id="UserId" class="form-control">
                                @foreach ($users as $user)
                                    @if($comment->user->name === $user->name)
                                        <option selected value="{{$user->id}}">{{$user->name}}</option>
                                    @else
                                        <option selected value="{{$user->id}}">{{$user->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email:</label>
                        <input disabled name="email" type="email" class="form-control" id="email"
                               value="{{$comment->user->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="col-form-label">Comment:</label>
                        <textarea name="comment" class="form-control" id="comment">{{$comment->comment}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary ml-auto">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
