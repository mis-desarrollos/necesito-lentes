<template>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">

			<div class="panel panel-primary" data-collapsed="0">

				<div class="panel-heading">
					<div class="panel-title">
						<i class="fa fa-store"></i> Opticas
					</div>
					<div class="panel-options">
						<a @click="$router.push('/opticians/')"><i class="fas fa-times"></i></a>
					</div>
				</div>

				<div class="panel-body">
					<form role="form" class="form-horizontal" @submit.prevent="newRow($event.target)">

						<input-form name="name" text="Nombre" :data.sync="row.name"></input-form>

                        <input-form name="email" text="Email" :data.sync="row.email"></input-form>

                        <input-form name="phone" text="Telefono" :data.sync="row.phone"></input-form>

                        <input-form name="web" text="Sitio web" :data.sync="row.web"></input-form>

                        <input-form name="instagram" text="Instagram" :data.sync="row.instagram"></input-form>

                        <input-form name="facebook" text="Facebook" :data.sync="row.facebook"></input-form>

                        <input-form name="twitter" text="Twitter" :data.sync="row.twitter"></input-form>

                        
                        <div class="form-group">
							<label class="col-sm-3 control-label">Estado:</label>
							<div class="col-sm-7">
								<v-select v-model="row.states_id" :options="estados" label="name" index="id" @change="getTowns" required/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Ciudad:</label>
							<div class="col-sm-7">
								<v-select v-model="row.towns_id" :options="ciudades" label="name" index="id" required/>
							</div>
						</div>

                        <div class="row">
							<p style="text-align:center;font-size: 17p;"><b>Da click sobre el mapa o arrastra el marcador para fijar la ubicacion</b></p>

							<div id="searchemap" v-if="mapLoaded">
								<b>Buscar Domicilio: </b><br>
								<vue-google-autocomplete
									id="map"
									classname="form-control"
									placeholder="Buscar..."
									v-on:placechanged="getAddressData"
									country="mx"
									:value="row.address"
									onfocus="this.removeAttribute('readonly');" 
									autocomplete="off"
									>
								</vue-google-autocomplete>
									
							</div>
							<br>

							<br>						        
							<div>
								<GmapMap
									:center="{lat:row.lat, lng:row.lng}"
									:zoom="16"
									map-type-id="terrain"
									style=" height: 300px"
									@click="setPlace($event)"
								>
								<GmapMarker
									:position="{lat:row.lat, lng:row.lng}"
									:clickable="true"
									:draggable="true" 
									@drag="updateCoordinates"/>
								</GmapMap>
							</div>
						</div><br>

						
						<div class="form-group">
							<div class="col-sm-12">
								<button type="button" class="btn btn-danger" @click="deleteRow" v-show="$route.params.id"><i class="fa fa-trash"></i> Borrar</button>
								<button type="submit" class="btn btn-success pull-right"><i class="far fa-save"></i> Guardar</button>
								<button type="button" class="btn btn-default pull-right" @click="$router.push('/opticians/')">Cancelar</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>

	</div>
</template>
<script type="text/javascript">
	export default {
		data(){
			return {
				row:{
					name: '',
                    address:null,
                    lat:20.66936598231273,
					lng:-103.34820660887827,
				},
				
				id: '',
				check:false,
                estados: [],
				ciudades: [],
                mapLoaded:false
			}
		},
		methods:{

			getRow(){
				this.$parent.inPetition=true;
				axios.get(tools.url("/api/admin/opticians/"+this.id)).then((response)=>{

			    	this.row = response.data;
					this.$parent.inPetition=false;
					
			    }).catch((error)=>{
			    	this.$parent.handleErrors(error);
			       this.$parent.inPetition=false;
			    });
			},

			newRow(form){
				this.$parent.inPetition=true;
				this.$parent.validateAll(()=>{
					var data=tools.params(form, this.row);
					if(this.$route.params.id){
						axios.post(tools.url("/api/admin/opticians/"+this.id),data)
						.then((response)=>{
					    	this.getRow();
					    	this.$parent.showMessage("Registro modificado correctamente!","success");
					    	this.$parent.inPetition=false;
					    }).catch((error)=>{
					    	this.$parent.handleErrors(error);
					        this.$parent.inPetition=false;
					    });
					}
					else{
						axios.post(tools.url("/api/admin/opticians"),data).then((response)=>{
							var temp = response.data;
					    	this.$parent.showMessage("Registro agregado correctamente!","success");
					    	this.$router.push('/opticians');
					    	this.$parent.inPetition=false;
					    }).catch((error)=>{
					    	this.$parent.handleErrors(error);
					        this.$parent.inPetition=false;
					    });
					}
				},(e)=>{
					console.log(e);
					this.$parent.inPetition=false;
				});
			},

			deleteRow:function(){
				alertify.confirm("Alerta!","¿Seguro que deseas borrar?",()=>{
					this.$parent.inPetition=true;
					axios.delete(tools.url("/api/admin/opticians/"+this.id))
					.then((response)=>{
						this.$parent.showMessage(response.data.msg,"success");
						this.$router.push("/opticians/");
						this.$parent.inPetition=false;
					})
					.catch((error)=>{
						this.$parent.handleErrors(error);
				        this.$parent.inPetition=false;
					});
				},
				()=>{
				});
			},
            getEstados(){
				axios.get(tools.url('/api/admin/states')).then((response)=>{
					this.estados = response.data;
				}).catch((error)=>{
					this.$parent.handleErrors(error);
				});
			},

			getTowns(state_id){
				axios.get(tools.url('/api/admin/towns/' + state_id)).then((response)=>{
					this.ciudades = response.data;
				}).catch((error)=>{
					this.$parent.handleErrors(error);
				});
			},
            getAddressData: function (addressData, placeResultData, id) {
     	
                $('#searchemap input.form-control').prop("readonly",false);
                this.row.lat = addressData.latitude;
                this.row.lng = addressData.longitude;

                this.row.address = placeResultData.formatted_address;
            },
            updateCoordinates(location) {
                this.row.lat = location.latLng.lat();
                this.row.lng = location.latLng.lng();


                var self = this;
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    latLng: location.latLng
                }, function(responses) {
                    if (responses && responses.length > 0) {
                    self.row.address = responses[0].formatted_address;
                    } 
                });
            },
            setPlace(event) {
                this.row.lat = event.latLng.lat();
                this.row.lng = event.latLng.lng();

                var self = this;
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    latLng: event.latLng
                }, function(responses) {
                    if (responses && responses.length > 0) {
                    self.row.address = responses[0].formatted_address;
                    } 
                });
            }
		},
		mounted(){
            this.getEstados();
			if(this.$route.params.id){
				this.id=this.$route.params.id;
				this.getRow();
			}
            if(this.row.states_id){
				this.getTowns(this.row.states_id);
			}

            var self = this;
			setTimeout(function(){
				self.mapLoaded = true;
			    
			}, 2000);
		}
	}
</script>
