@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ $channel->name }}

                    <a href="{{ route('channel.upload', $channel->id) }}">Upload Videos</a>
                </div>

                <div class="card-body">
                    @if($channel->editable())
                    <form id="update-channel-form" action="{{ route('channels.update', $channel->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                    @endif

                        <div class="form-group row justify-content-center">
                            <div class="channel-avatar">
                                @if($channel->editable())
                                    <div onclick="document.getElementById('image').click()" class="channel-avatar-overlay">
                                        <svg xmlns="http://www.w3.org/2000/svg"  xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve" width="50px" height="50px" class=""><g><g>
                                                <path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#ffffff" fill="#ffffff"/>
                                                <path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#ffffff" fill="#ffffff"/>
                                                <path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#ffffff" fill="#ffffff"/>
                                                <path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#ffffff" fill="#ffffff"/>
                                        </g></g> </svg>
                                    </div>
                                @endif
                                <img src="{{ $channel->image() }}" alt="">
                            </div>
                        </div>

                        <div class="form-group">
                            <h4 class="text-center">
                                {{ $channel->name }}
                            </h4>
                            <p class="text-center">
                                {{ $channel->description }}
                            </p>

                            <div class="text-center">
                                <subscribe-button :channel="{{ $channel }}" :initial-subscriptions="{{ $channel->subscriptions }}" />
                            </div>
                        </div>

                        @if($channel->editable())
                            <input onchange="document.getElementById('update-channel-form').submit()" style="display: none;"  id="image" type="file" name="image">
                            
                            <div class="form-group">
                                <label for="name" class="form-control-label">
                                    Name
                                </label>
                                <input id="name" name="name" value="{{ $channel->name }}" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-control-label">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="3" class="form-control">{{ $channel->description }}</textarea>
                            </div>

                            @if($errors->any())
                                <ul class="list-group mb-5">
                                    @foreach($errors->all() as $error)
                                        <li class="text-danger list-group-item">
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <button type="submit" class="btn btn-info">
                                Update Channel
                            </button>
                        @endif

                    @if($channel->editable())
                    </form>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Videos
                </div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($videos as $video)
                                <tr>
                                    <td>
                                        <img width="40px" height="40px" src="{{ $video->thumbnail }}" alt="">
                                    </td>
                                    <td>
                                        {{ $video->title }}
                                    </td>
                                    <td>
                                        {{ $video->views }}
                                    </td>
                                    <td>
                                        {{ $video->percentage === 100 ? 'Live' : 'Processing' }}
                                    </td>
                                    <td>
                                        @if($video->percentage === 100)
                                            <a href="{{ route('videos.show', $video->id) }}" class="btn btn-sm btn-info">
                                                View
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row justify-content-center">
                        {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
