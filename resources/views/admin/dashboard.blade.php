<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-inline">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="25" fill="currentColor"
                class="bi bi-speedometer d-inline" viewBox="0 0 16 16">
                <path
                    d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                <path fill-rule="evenodd"
                    d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
            </svg> {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Articles
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php if ($data['articles']->count() == 0) {
                            echo '<b>the system has no data</b>';
                        } else {
                            echo 'you have ' . $data['articles']->count() . ' articles';
                        } ?></h5>
                        <p class="card-text">last article added in: <?php if ($data['articles']->count() == 0) {
                            echo '<i>the system has no data</i>';
                        } else {
                            echo $data['articles']->last()->created_at;
                        } ?></p>
                        <a href="/articles" class="btn btn-primary">Full details...</a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Consultants</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php if ($data['consults']->count() == 0) {
                            echo '<b>the system has no data</b>';
                        } else {
                            echo 'total consultants count is : ' . $data['consults']->count();
                        } ?></h5>
                        <p class="card-text">unreplied consultants count is: 0 <span></span></p>
                        <a href="/consultants" class="btn btn-primary">Full details...</a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Calculations</div>
                    <div class="card-body">
                        <h5 class="card-title">total consultants count is :</h5>
                        <p class="card-text">unreplied consultants count is: <span></span></p>
                        <a href="/consultants" class="btn btn-primary">Full details...</a>
                    </div>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
