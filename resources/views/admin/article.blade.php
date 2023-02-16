<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($data->title) }}

        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 border border-success border-opacity-50">
                <div class="m-5">
                    <dl class="row">
                        <dt class="col-sm-3">Title:</dt>
                        <dd class="col-sm-9">
                            {{ $data->title }}
                        </dd>

                        <dt class="col-sm-3">Content:</dt>
                        <dd class="col-sm-9">
                            {{ $data->content }}
                        </dd>
                        <dt class="col-sm-3">Category:</dt>
                        <dd class="col-sm-9">
                            {{ $data->category->cat_name }}
                        </dd>
                        <dt class="col-sm-3">Posted By:</dt>
                        <dd class="col-sm-9">{{ $data->user->name }}</dd>

                        <dt class="col-sm-3 text-truncate">Created Date</dt>
                        <dd class="col-sm-9">{{ $data->created_at }}
                        </dd>

                    </dl>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <form action="/EditArticle" method="POST">
                                <button type="submit" class="btn btn-outline-primary">Edit Article</button>
                            </form>
                        </li>
                        <li class="list-inline-item">
                            <form action="/nextArticle?id={{ $data->id }}" method="POST">
                                <button type="submit" class="btn btn-outline-success">Next Article</button>
                            </form>
                        </li>
                        <li class="list-inline-item">
                            <form action="/DeleteArticle" method="POST">
                                <button type="submit" class="btn btn-outline-danger">Delete Article</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

</x-app-layout>


<script></script>
