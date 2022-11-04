<template>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			
			<div class="panel panel-primary" data-collapsed="0">
			
				<div class="panel-heading">
					<div class="panel-title">
						<i class="fa fa-angle-right"></i> Blog
					</div>
					<div class="panel-options">
						<a @click="$router.push('/blogs/')"><i class="fas fa-times"></i></a>
					</div>
				</div>
				
				<div class="panel-body">
					<form role="form" class="form-horizontal" @submit.prevent="newNews($event.target)">

						<input-form name="title" text="Titulo" :data.sync="news.title" validate="required"></input-form>
						
						<div class="form-group">
							<label for="editor2" class="col-sm-3 control-label">Cuerpo</label>
							<div class="col-sm-7">
								<vue-editor id="editor2"  v-model="news.body" :editorToolbar="customToolbar"></vue-editor>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12">
								<button type="button" class="btn btn-danger" @click="deleteNews" v-show="$route.params.id"><i class="fa fa-trash"></i> Borrar</button>
								<button type="submit" class="btn btn-success pull-right"><i class="far fa-save"></i> Guardar</button> 
								<button type="button" class="btn btn-default pull-right" @click="$router.push('/blogs/')">Cancelar</button>			
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
				news:{
					title:"",
					body:""
				},
				id:"",
				customToolbar: [
					[{ 'font': [] }],
					[{ 'header': [false, 1, 2, 3, 4, 5, 6, ] }],
					['bold', 'italic', 'underline'],
					[{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
					[{ 'list': 'ordered'}, { 'list': 'bullet' }]//,
					//['image', 'code-block']
				],
			}
		},

		methods:{
			getNews(){
				this.$parent.inPetition=true;

				axios.get(tools.url("/api/admin/blogs/"+this.id))
				.then((response)=>{
			    	this.news = response.data;
			    	this.$parent.inPetition=false;
			    }).catch((error)=>{
			    	this.$parent.handleErrors(error);
			        this.$parent.inPetition=false;
			    });
			},
			
			newNews(form){				
				this.$parent.inPetition=true;
				this.$parent.validateAll(()=>{

					var data=tools.params(form,this.news);
					if(this.$route.params.id){
						axios.post(tools.url("/api/admin/blogs/"+this.id),data)
						.then((response)=>{
					    	this.getNews();
					    	this.$parent.showMessage("Noticia "+this.news.title+" modificado correctamente!","success");
					    	this.$parent.inPetition=false;
					    }).catch((error)=>{
					    	this.$parent.handleErrors(error);
					        this.$parent.inPetition=false;
					    });
					}
					else{
						axios.post(tools.url("/api/admin/blogs"),data)
						.then((response)=>{
							var news = response.data;
					    	this.$parent.showMessage("Noticia "+news.title+" agregada correctamente!","success");
					    	this.$router.push('/blogs/'+news.id);
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
			deleteNews:function(){
				alertify.confirm("Alerta!","¿Seguro que deseas borrar esta noticia?",()=>{
					this.$parent.inPetition=true;
					axios.delete(tools.url("/api/admin/blogs/"+this.id))
					.then((response)=>{
						this.$parent.showMessage(response.data.msg,"success");
						this.$router.push("/blogs/");
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

		},
		mounted(){
			if(this.$route.params.id){
				this.id=this.$route.params.id;
				this.getNews();
			}
		}
	}
</script>