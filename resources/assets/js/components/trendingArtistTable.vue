<template>
    <div class="box">
            <div class="box-header">
                <h3 class="box-title">Trending Artists</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Categories</th>
                            <th>followers</th>
                            <th>tracks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="artist in artists">
                            <td>{{ artist.name }}</td>
                            <td>{{ artist.category.name }}</td>
                            <td>{{ artist.followers.length }}</td>
                            <td>{{ artist.tracks.length }}</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div>
</template>

<script type="text/javascript">
	export default {
		props: ['artists']
	}
</script>