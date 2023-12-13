<template>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">

			<div class="panel panel-primary" data-collapsed="0">

				<div class="panel-heading">
					<div class="panel-title">
						<i class="fa fa-glasses"></i> Armazones

					</div>
					<div class="panel-options">
						<a @click="$router.push('/frames/')"><i class="fas fa-times"></i></a>
					</div>
				</div>

				<div class="panel-body">
                    <div id="tabs" >
                        <ul class="nav nav-tabs">
                            <li :class="active1"><a @click="setActive(1)" href="#1" data-toggle="tab">Información</a></li>
                            <li :class="active2" v-if="id"><a @click="setActive(2)" href="#2" data-toggle="tab">Imagenes</a></li>   
                        </ul>
                        <div class="tab-content">
                            <div :class=" 'tab-pane ' + active1" id="1">
                                <form role="form" class="form-horizontal" @submit.prevent="newRow($event.target)">

                                    <input-form name="name" text="Nombre" :data.sync="row.name"></input-form>

                                    <text-form name="description" text="Descripcion" :data.sync="row.description"></text-form>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Material:</label>
                                        <div class="col-sm-7">
                                            <v-select v-model="row.materials_id" :options="materials" label="name" index="id" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Paquete:</label>
                                        <div class="col-sm-7">
                                            <v-select v-model="row.packages_id" :options="packages" label="name" index="id" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-danger" @click="deleteRow" v-show="$route.params.id"><i class="fa fa-trash"></i> Borrar</button>
                                            <button type="submit" class="btn btn-success pull-right"><i class="far fa-save"></i> Guardar</button>
                                            <button type="button" class="btn btn-default pull-right" @click="$router.push('/frames/')">Cancelar</button>
                                        </div>
                                    </div>

                                    </form>
                            </div>
                            <div :class=" 'tab-pane ' + active2" id="2">
                                <vue-dropzone ref="VueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-complete="onUpload"></vue-dropzone>
									<br><br>
								<table v-if="row.images.length > 0" id="tableproducts">
										<tr>
											<th>Imagen</th>
											<th>Eliminar</th>
										</tr>
										<tr v-for="(image, index) in row.images" :key="index">
											<td><img :src="image.url" class="img-thumbnail" width="100"></td>
													
											<td><button  class="btn btn-danger" @click="deleteImage(image.id)"><i class="fa fa-times"></i></button></td>
										</tr>
								</table>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

	</div>
</template>
<script type="text/javascript">
	export default {
		data(){
			return {
                active:1,
				row:{
					name: '',
                    images:[]
				},
				
				id: '',
				check:false,
                materials:[],
                packages:[],

                dropzoneOptions: {
		     		url: tools.url('/api/admin/dropzone/framesImage/' + this.$route.params.id),
		            acceptedFiles:'image/*',
		            uploadMultiple:false,
		            maxFilesize:3,
                    withCredentials:false,
		        },
			}
		},
        computed:{
            active1: function()
            {
                return (this.active == 1) ? 'active' : '';
            },
            active2: function()
            {
                return (this.active == 2) ? 'active' : '';
            },
           

        },
		methods:{
            setActive(val)
            {
                this.active = val;
            },
			getRow(){
				this.$parent.inPetition=true;
				axios.get(tools.url("/api/admin/frames/"+this.id)).then((response)=>{

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
						axios.post(tools.url("/api/admin/frames/"+this.id),data)
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
						axios.post(tools.url("/api/admin/frames"),data).then((response)=>{
							var temp = response.data;
					    	this.$parent.showMessage("Registro agregado correctamente!","success");
					    	this.$router.push('/frames/edit/'+temp.id);
                            location.reload();
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
					axios.delete(tools.url("/api/admin/frames/"+this.id))
					.then((response)=>{
						this.$parent.showMessage(response.data.msg,"success");
						this.$router.push("/frames/");
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
            getMaterialsOpcs(){
                axios.get(tools.url("/api/admin/materials")).then((response)=>{
                    this.materials = response.data.data;
                }).catch((error)=>{
                });
            },
            getPackagesOpcs(){
                axios.get(tools.url("/api/admin/packages")).then((response)=>{
                    this.packages = response.data;
                }).catch((error)=>{
                });
            },
            //Manejador de evento onUpload del dropZone
			onUpload(file, response) {
				setTimeout(() => {
		        	let vueDropzone = this.$refs['VueDropzone'];
					vueDropzone.removeFile(file);
					this.getRow();
				}, 1000);

			},
			//Borrar una image de la galeria del paquete
			deleteImage(id) {
				alertify.confirm("Alerta!","¿Seguro que desea eliminar esta imagen?",() => {
					axios.delete(tools.url("/api/admin/dropzone/framesImage/" + id )).then(result => {
						this.getRow();
						this.$parent.showMessage(result.data.msg, "success");
					}).catch(error => {
						this.$parent.handleErrors(error);
					});
				}, ()=>{});
			},
		},
		mounted(){
            this.getMaterialsOpcs();
            this.getPackagesOpcs();
			if(this.$route.params.id){
				this.id=this.$route.params.id;
				this.getRow();
			}
		}
	}
</script>
<style>
table, #tableproducts{
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

table #tableproducts, td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

table #tableproducts, th {
  background-color: #dddddd;
}
</style>
