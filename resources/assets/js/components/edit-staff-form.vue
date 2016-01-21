<style>
	
</style>

<template>
	<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">{{ staff.name | capitalize }}</h4>
	      </div>
	      <form @submit.prevent="updateStaff">
		      <div class="modal-body">
		        	<div class="form-group">
	                    <label for="name">Staff Name</label>
	                    <input v-model="staffBuffer.name"
	                           required
	                           type="text"
	                           name="name"
	                           class="form-control"
	                           id="staffName"
	                           placeholder="Name">
	                </div>
	                <div class="form-group">
	                    <label for="name">Staff Email</label>
	                    <input v-model="staffBuffer.email"
	                           required
	                           type="email" name="email"
	                           class="form-control"
	                           id="StaffEmail"
	                           placeholder="Email">
	                </div>
	                <div class="form-group">
	                    <label for="staffRole">Role</label>
	                    <select v-model="staffBuffer.role_id"
	                            required
	                            name="role_id"
	                            class="form-control"
	                            id="staffRole"  style="width: 100%;">
	                        <option v-for="role in roles"
	                                :value="role.id">
	                            {{ role.title | capitalize }}
	                        </option>
	                    </select>
	                </div>
		      </div>
		      <div class="modal-footer">
		        <button data-dismiss="modal" type="button" class="btn btn-default">Close</button>
		        <button type="submit" class="btn btn-primary">Save changes</button>
		      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</template>	

<script>
	export default {
		props: ['staff', 'roles'],
		methods:{
			updateStaff(){
				let name = this.staffBuffer.name.trim();
				let email = this.staffBuffer.email.trim();
				if(name && email){
					this.staff.name = this.staffBuffer.name;
					this.staff.email = this.staffBuffer.email;
					this.staff.role.id = this.staffBuffer.role_id;
					$('#myModal').modal('hide');
				}
			},
			setBuffer(staff){
				this.staffBuffer.name = staff.name;
				this.staffBuffer.email = staff.email;
				this.staffBuffer.role_id = staff.role.id;
			}
		},
		data(){
			return {
				staffBuffer: {
					name: '',
					email: '',
					role_id: null
				}
			}
		},
		ready(){
			// this.setBuffer(this.staff);
		},
		events: {
			'edit-staff': function(staff){
				console.log('form got '+ staff.name);
				this.setBuffer(staff);
			}
		}
	}
</script>