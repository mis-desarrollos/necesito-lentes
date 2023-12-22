<template>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">

			<div class="panel panel-primary" data-collapsed="0">

				<div class="panel-heading">
					<div class="panel-title">
						<i class="fa fa-box"></i> Paquetes
					</div>
					<div class="panel-options">
						<a @click="$router.push('/packages/')"><i class="fas fa-times"></i></a>
					</div>
				</div>

				<div class="panel-body">
					<form role="form" class="form-horizontal" @submit.prevent="newRow($event.target)">

						<input-form name="name" text="Nombre" :data.sync="row.name"></input-form>

						<input-form name="price" text="Precio" :data.sync="row.price"></input-form>

						<input-form name="level" text="Nivel" :data.sync="row.level"></input-form>

						<text-form name="description" text="Descripcion" :data.sync="row.description"></text-form>

						<div class="form-group">
							<label class="col-sm-3 control-label">Armazones:</label>
							<div class="col-sm-7">
								<v-select v-model="row.frames" :options="frames" label="name" multiple id="frame-select"
									index="id" />
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<button type="button" class="btn btn-danger" @click="deleteRow" v-show="$route.params.id"><i
										class="fa fa-trash"></i> Borrar</button>
								<button type="submit" class="btn btn-success pull-right"><i class="far fa-save"></i>
									Guardar</button>
								<button type="button" class="btn btn-default pull-right"
									@click="$router.push('/packages/')">Cancelar</button>
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
	data() {
		return {
			row: {
				name: 'paquete 1',
				price: 1000,
				level: 1,
				description: 'paquete 1',
				frames: []
			},
			id: '',
			check: false,
			frames: [],
		}
	},
	methods: {
		getRow() {
			this.$parent.inPetition = true;
			axios.get(tools.url("/api/admin/packages/" + this.id)).then((response) => {
				this.row = response.data?.data;
				this.row.frames = response.data?.data.frames.map(f => f.id);
				this.$parent.inPetition = false;
			}).catch((error) => {
				this.$parent.handleErrors(error);
				this.$parent.inPetition = false;
			});
		},
		newRow(form) {
			this.$parent.inPetition = true;
			this.$parent.validateAll(() => {
				let nRow = {...this.row};
				console.log(nRow);
				const data = tools.params(form, nRow);
				if (this.$route.params.id) {
					axios.post(tools.url("/api/admin/packages/" + this.id), data)
						.then((response) => {
							this.getRow();
							this.$parent.showMessage("Registro modificado correctamente!", "success");
							this.$parent.inPetition = false;
						}).catch((error) => {
							console.log(error);
							this.$parent.handleErrors(error);
							this.$parent.inPetition = false;
						});
				}
				else {
					axios.post(tools.url("/api/admin/packages"), data).then((response) => {
						var temp = response.data;
						this.$parent.showMessage("Registro agregado correctamente!", "success");
						this.$router.push('/packages');
						this.$parent.inPetition = false;
					}).catch((error) => {
						this.$parent.handleErrors(error);
						this.$parent.inPetition = false;
					});
				}
			}, (e) => {
				console.log(e);
				this.$parent.inPetition = false;
			});
		},

		deleteRow: function () {
			alertify.confirm("Alerta!", "¿Seguro que deseas borrar?", () => {
				this.$parent.inPetition = true;
				axios.delete(tools.url("/api/admin/packages/" + this.id))
					.then((response) => {
						this.$parent.showMessage(response.data.msg, "success");
						this.$router.push("/packages/");
						this.$parent.inPetition = false;
					})
					.catch((error) => {
						this.$parent.handleErrors(error);
						this.$parent.inPetition = false;
					});
			},
				() => {
				});
		},

		getFramesOpc() {
			axios.get(tools.url("/api/admin/frames")).then((response) => {
				this.frames = response.data?.data;
			}).catch((error) => {
				
			});
		},
	},
	mounted() {
		this.getFramesOpc();
		if (this.$route.params.id) {
			this.id = this.$route.params.id;
			this.getRow();
		}
	}
}
</script>
