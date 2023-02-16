<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
        <form action="/addNewArticle">
            <button type="submit" class="btn btn-success">Add new article</button>
        </form>
    </x-slot>

    <div class="container mt-4">


        <table class="table table-hover" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">creator</th>
                    <th scope="col">title</th>
                    <th scope="col">content</th>
                    <th scope="col">number of views</th>
                    <th scope="col">creation date</th>
                    <th scope="col">Action</th>


                </tr>
            </thead>
            <tbody id="myTable">
                <?php foreach ($articles as $index):?>
                <tr>


                    <td><?php echo $index->id; ?></td>
                    <td><?php echo $index->user->name; ?></td>
                    <td><?php echo $index->title; ?></td>
                    <td><?php echo substr($index->content, 0, 10) . '....'; ?></td>
                    <td><?php echo $index->number_of_views; ?></td>
                    <td><?php echo $index->created_at; ?></td>
                    <td><a href="/article/?id=<?php echo $index->id; ?>">specification</a></td>
                    <?php endforeach;?>
                </tr>
            </tbody>
        </table>


    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
