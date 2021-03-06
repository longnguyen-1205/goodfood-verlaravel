@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-title">
                    {{ __($data[0]->storename) }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="text-primary">
                                <span class="display-2">
                                    {{ __($vote[0]->vote) }}
                                </span>
                                <span class="display-4">
                                    /5
                                </span>
                            </div>
                            @for($i = 1; $i <= round($vote[0]->vote); $i ++)
                            <span class="fa fa-star checked display-4">
                            </span>
                            @endfor
                                @for($i = 5; $i > round($vote[0]->vote); $i --)
                            <span class="fa fa-star display-4">
                            </span>
                            @endfor
                            <div class="text-info">
                                {{ __($vote[0]->sum) }}件レビュー& {{ __($like[0]->sum) }}件いいね
                            </div>
                            <div>
                                {{ __($data[0]->address) }}
                            </div>
                            <div>
                                {{ __($data[0]->opentime) }}~{{ __($data[0]->closetime) }}
                            </div>
                            <div>
                                @foreach($data2 as $role )
                                <span>
                                    {{ __($role->role) }}
                                </span>
                                @endforeach
                            </div>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://maps.google.com/maps?hl=ja&q={{ __($data[0]->storename.$data[0]->address)}}&z=18&ie=UTF8&t=k&iwloc=A&output=embed">
                                </iframe>
                            </div>
                        </div>
                        <div class="col-md-5 mt-4">
                            <h1 class="text-muted">
                                おすすめと評価
                            </h1>
                            @if(!$islike)
                            <a href="/likeordis/{{$id}}/like">
                                <button class="btn btn-block btn-primary mt-4">
                                    <i class="fa fa-thumbs-up">
                                        Like
                                    </i>
                                </button>
                            </a>
                            @else
                            <a href="/likeordis/{{$id}}/unlike">
                                <button class="btn btn-block bg-secondary mt-4">
                                    <i class="fa fa-thumbs-down">
                                        DisLike
                                    </i>
                                </button>
                            </a>
                            @endif
                            <div class="form-group">
                                <form method="POST" action="{{ route('cmtstore') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="sid" value="{{$id}}">

                                <label class="display-4 mt-4 text-secondary" for="comment">
                                    評価
                                </label>
                                <div>
                                    <input class="star star-5" id="star-5" name="point" type="radio" value="5"/>
                                    <label class="star star-5" for="star-5">
                                    </label>
                                    <input class="star star-4" id="star-4" name="point" type="radio" value="4"/>
                                    <label class="star star-4" for="star-4">
                                    </label>
                                    <input class="star star-3" id="star-3" name="point" type="radio" value="3"/>
                                    <label class="star star-3" for="star-3">
                                    </label>
                                    <input class="star star-2" id="star-2" name="point" type="radio" value="2"/>
                                    <label class="star star-2" for="star-2">
                                    </label>
                                    <input class="star star-1" id="star-1" name="point" type="radio" value="1"/>
                                    <label class="star star-1" for="star-1">
                                    </label>
                                </div>
                                <textarea class="form-control" id="comment" name="comment" rows="5">
                                </textarea>
                                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1"></input>
                                
                                    <button type="submid" class="btn btn-block btn-primary">
                                        {{ __('送信') }}
                                    </button>
                                    <button type="reset" class="btn btn-block bg-secondary">
                                        {{ __('取り消し') }}
                                    </button>
                                     @error('comment')
                                    <div class="text-danger">
                                        <strong>
                                            {{ "コメントを入力して下さい。" }}
                                        </strong>
                                    </div>
                                    @enderror
                                                               @error('point')
                                    <div class="text-danger">
                                        <strong>
                                            {{ "採点は必須です。" }}
                                        </strong>
                                    </div>
                                    @enderror
                                    @error('image')
                                    <div class="text-danger">
                                        <strong>
                                            {{ $message  }}
                                        </strong>
                                    </div>
                                    @enderror

                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    {{ __('口コミ') }}
                </div>
                <div class="card-body">
                    @foreach($cmt as $c)
                    <div class="row mt-4 bg-light">
                        <div class="col-md-12 col-form-label text-md-right">
                            <i class="fa fa-user-circle-o"></i>{{ __($c->name) }}  
                        </div>
                        <div class="col-md-12 col-form-label text-md-right text-muted">{{ __($c->created_at) }}にリビュー済み</div>
                        <div class="col-md-12 text-md-right">
                            @for($i = 1; $i <= round($c->votes); $i ++)
                            <span class="fa fa-star checked">
                            </span>
                            @endfor
                                @for($i = 5; $i > round($c->votes); $i --)
                            <span class="fa fa-star ">
                            </span>
                            @endfor
                        </div>
                        <div class="col-md-12 col-form-label text-md-left">
                            {{ __($c->cmt) }}
                        </div>
                        @if((file_exists(public_path('img/'.$c->cid))))
                        <div class="col-md-12">
                            <img src="{{ asset('img/'.$c->cid) }}" class="img-fluid" >
                        </div>
                        @endif
                        <div class="col-md-12 bg-light"><br>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer ">
                </div>
            </div>
            <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        @if($page>0)
                        <li class="page-item"><a class="page-link" href="?page={{ $page-1  }}">prev</a></li>
                        @endif
                        @if($vote[0]->sum)
                        <li class="page-item"><div class="input-group-prepend"><button class="page-link dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $page+1 }} of {{ CEIL($vote[0]->sum/5) }}</button>
                            <div class="dropdown-menu">
                                @for($i=0;$i<CEIL($vote[0]->sum/5);$i++)
                                <a class="page-link" href="?page={{ $i }}">{{ $i+1 }}</a>
                                @endfor
                            </div>
                        </div>
                        @endif
                        
                    </li>
                    @if($vote[0]->sum/5>$page+1)
                    <li class="page-item"><a class="page-link" href="?page={{ $page+1  }}">next</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
