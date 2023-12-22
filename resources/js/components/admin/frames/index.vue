<template>
  <div>
    <ol class="breadcrumb 2">
      <li><router-link to="/home"><i class="entypo-home"></i>Home</router-link></li>
      <li class="active"><strong>Armazones</strong></li>
    </ol>
    <h2 class="margin-bottom">Armazones</h2>

    <div class="row">
      <div class="col-md-12">
        <div id="toolbar">
          <router-link to="/frames/edit">
            <button class="btn btn-success btn-sm">
              <i class="fa fa-plus"></i> Nuevo
            </button>
          </router-link>
          <button class="btn btn-danger btn-sm" @click="deleteRows()">
            <i class="fa fa-trash"></i> Borrar
          </button>
        </div>
        <table id="table"></table>
      </div>
    </div>
  </div>
</template>
<script type="text/javascript">
export default {
  data() {
    return {
      rows: [],
    }
  },
  methods: {
    mounthTable() {
      jQuery('#table').bootstrapTable({
        columns: [
          {
            field: "check",
            checkbox: true,
            align: 'center',
          },
          {
            field: 'image',
            title: ' ',
            sortable: false,
            width: "52px",
          },
          {
            field: 'id',
            title: '#',
            sortable: true,
            switchable: true,
          },
          {
            field: 'name',
            title: 'Nombre',
            sortable: true,
            switchable: true,
          },
          {
            field: 'description',
            title: 'Descripcion',
            sortable: true,
            switchable: true,
          },
          {
            field: 'package',
            title: 'Package',
            sortable: true,
            switchable: true,
            formatter: function (index, row) {
              return row.package?.name
            }
          },
          {
            field: 'images',
            title: 'Imágenes',
            formatter: function (value, row, index) {
              if (value && value.length > 0) {
                let imagesHTML = '';
                value.forEach(function (image) {
                  imagesHTML += '<img src="' + image.path + '" alt="Imagen" height="50">';
                });
                return imagesHTML;
              } else {
                return 'No hay imágenes';
              }
            }
          },
        ],
        showRefresh: true,
      });

      jQuery('#table').on('refresh.bs.table', () => {
        this.getContent();
      });

      jQuery('#table').on('click-row.bs.table', (row, data) => {
        this.$router.push('/frames/edit/' + data.id);
      });

      this.getContent();

    },

    async getContent() {
      try {
        this.$parent.inPetition = true;
        const response = await axios.get(tools.url("/api/admin/frames"));
        this.rows = response.data?.data;
        console.log(this.rows);
        jQuery('#table').bootstrapTable('removeAll');
        jQuery('#table').bootstrapTable('append', this.rows);
        this.$parent.inPetition = false;
      } catch (error) {
        this.$parent.handleErrors(error);
      } finally {
        this.$parent.inPetition = false;
      }
    },


    deleteRows: function () {
      const rows = jQuery('#table').bootstrapTable('getSelections');
      if (rows.length == 0) {
        return false;
      }
      alertify.confirm("Alerta!", "¿Seguro que deseas borrar " + rows.length + " registros?", () => {
        this.$parent.inPetition = true;
        const params = {};
        params.ids = jQuery.map(rows, (row) => {
          return row.id;
        });

        axios.delete(tools.url('/api/admin/frames/multiple'), { data: params })
          .then((response) => {
            this.$parent.showMessage(response.data.message, "success");
            this.getContent();
            this.$parent.inPetition = false;
          })
          .catch((error) => {
            this.$parent.handleErrors(error);
            this.$parent.inPetition = false;
          });
      },
        () => {
        });
    }
  },
  mounted() {
    this.mounthTable();
  }
}
</script>
  