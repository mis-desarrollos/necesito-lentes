<template>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-primary" data-collapsed="0">

				<div class="panel-heading">
					<div class="panel-title">
						<i class="fa fa-cubes"></i> Antireflejantes
					</div>
					<div class="panel-options">
						<a @click="$router.push('/antireflectives/')"><i class="fas fa-times"></i></a>
					</div>
				</div>

				<div class="panel-body">
					<form role="form" class="form-horizontal" @submit.prevent="newRow($event.target)">

						<input-form name="name" text="Nombre" :data.sync="row.name"></input-form>

						<text-form name="description" text="Descripcion" :data.sync="row.description"></text-form>

						<div class="form-group">
							<label class="col-sm-3 control-label">Package:</label>
							<div class="col-sm-7">
								<v-select v-model="row.package" :options="packages" label="name" index="id" required />
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<button type="button" class="btn btn-danger" @click="deleteRow" v-show="$route.params.id"><i
										class="fa fa-trash"></i> Borrar</button>
								<button type="submit" class="btn btn-success pull-right"><i class="far fa-save"></i>
									Guardar</button>
								<button type="button" class="btn btn-default pull-right"
									@click="$router.push('/antireflectives/')">Cancelar</button>
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
				name: '',
				package: undefined
			},

			id: '',
			check: false,
			packages: []
		}
	},
	methods: {

		getRow() {
			this.$parent.inPetition = true;
			axios.get(tools.url("/api/admin/antireflectives/" + this.id)).then((response) => {
				this.row = response.data;
				this.row.package = response.data.package?.id
				this.$parent.inPetition = false;

			}).catch((error) => {
				this.$parent.handleErrors(error);
				this.$parent.inPetition = false;
			});
		},

		newRow(form) {
			this.$parent.inPetition = true;
			this.$parent.validateAll(() => {
				var data = tools.params(form, this.row);
				if (this.$route.params.id) {
					axios.post(tools.url("/api/admin/antireflectives/" + this.id), data)
						.then((response) => {
							this.getRow();
							this.$parent.showMessage("Registro modificado correctamente!", "success");
							this.$parent.inPetition = false;
						}).catch((error) => {
							this.$parent.handleErrors(error);
							this.$parent.inPetition = false;
						});
				}
				else {
					axios.post(tools.url("/api/admin/antireflectives"), data).then((response) => {
						var temp = response.data;
						this.$parent.showMessage("Registro agregado correctamente!", "success");
						this.$router.push('/antireflectives');
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
				axios.delete(tools.url("/api/admin/antireflectives/" + this.id))
					.then((response) => {
						this.$parent.showMessage(response.data.msg, "success");
						this.$router.push("/antireflectives/");
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

		getPackages() {
			axios.get(tools.url("/api/admin/packages")).then((response) => {
				this.packages = response.data;
				this.$parent.inPetition = false;
			}).catch((error) => {
				this.$parent.handleErrors(error);
				this.$parent.inPetition = false;
			});
		},
	},
	mounted() {
		if (this.$route.params.id) {
			this.id = this.$route.params.id;
			this.getRow();
		}
		this.getPackages()
	}
}
</script>
