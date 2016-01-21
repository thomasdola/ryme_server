<template>
	<div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#trending_tracks" data-toggle="tab">Trending Tracks</a></li>
            <li><a href="#trending_artists" data-toggle="tab">Trending Artists</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="trending_tracks">
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Artist(s)</th>
                                <th>Stream(s)</th>
                                <th>Download(s)</th>
                                <th>Favorite(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="#">thomas</a></td>
                            <td>thomas</td>
                            <td>20</td>
                            <td>20</td>
                            <td>20</td>
                        </tr>
                        </tbody>
                    </table><!-- /.table -->
                </div>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="trending_artists">
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>followers</th>
                                <th>tracks</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="#">thomas</a></td>
                            <td>20</td>
                            <td>20</td>
                        </tr>
                        </tbody>
                    </table><!-- /.table -->
                </div>
            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </div>
</template>

<script>
	export default {
		props: ['active'],
		methods: {},
		computed: {},
		data(){
			return {}
		},
        ready(){
            console.log(this.active.name + " from active detail");
        },
        watch: {
            'active': function(category){
                this.$emit('category-changed', category);
            }
        },
        events: {
            'category-changed': function(category){
                console.log('got '+ category.name);
            }
        }
	}
</script>