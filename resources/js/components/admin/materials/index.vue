<template>
    <div>
        <ol class="breadcrumb 2">
            <li><router-link to="/home"><i class="entypo-home"></i>Home</router-link></li>
            <li class="active"><strong>Materiales</strong></li>
        </ol>
        <h2 class="margin-bottom">Materiales</h2>

        <div class="row">
            <div class="col-md-12">
                <div id="toolbar">
                    <router-link to="/materials/edit">
                        <button class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> Nuevo
                        </button>
                    </router-link>
                    <button class="btn btn-danger btn-sm" @click="deleteRows()">
                        <i class="fa fa-trash"></i> Borrar
                    </button>
                </div>
                <table id="table" data-pagination-parts="[]"></table>
                <nav aria-label="pagination" style="width: 100%; text-align: center;">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" @click="getContent(pagination.current_page - 1)"
                                :disabled="!pagination.existsPrevPage">
                                Previous
                            </a>
                        </li>
                        <li class="page-item" v-for="num_page in pagination.total_pages" :key="num_page">
                            <a class="page-link" @click="getContent(num_page)"
                                :style="pagination.current_page == num_page ? 'background: #3097d1; color: white;' : ''">
                                {{ num_page }}
                            </a>
                        </li>
                        <li class="page-item" v-if="pagination.existsNextPage">
                            <a class="page-link" @click="getContent(pagination.current_page + 1)"
                                :disabled="!pagination.existsNextPage">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
export default {
    data() {
        return {
            rows: [],
            pagination: {
                current_page: 1,
                total_pages: 1,
                existsNextPage: false,
                existsPrevPage: false,
            }
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
                        formatter: this.pacakgeName                        
                    },
                ],
                showRefresh: true,
            });

            jQuery('#table').on('refresh.bs.table', () => {
                this.getContent();
            });

            jQuery('#table').on('click-row.bs.table', (row, data) => {
                this.$router.push('/materials/edit/' + data.id);
            });

            this.getContent();

        },

        getContent(page = 1) {
            this.$parent.inPetition = true;
            let params = {}
            params.page = Number(page)
            axios.get(tools.url("/api/admin/materials"), { params }).then((response) => {
                this.rows = response.data.data;
                this.pagination = {
                    total_pages: response.data.meta?.last_page,
                    current_page: page,
                    existsNextPage: response.data.links.next && true,
                    existsPrevPage: response.data.links.prev && true,
                }
                jQuery('#table').bootstrapTable('removeAll');
                jQuery('#table').bootstrapTable('append', this.rows);
                this.$parent.inPetition = false;
            }).catch((error) => {
                this.$parent.handleErrors(error);
                this.$parent.inPetition = false;
            });
        },

        deleteRows: function () {
            var rows = jQuery('#table').bootstrapTable('getSelections');
            if (rows.length == 0) {
                return false;
            }
            alertify.confirm("Alerta!", "¿Seguro que deseas borrar " + rows.length + " registros?", () => {
                this.$parent.inPetition = true;
                var params = {};
                params.ids = jQuery.map(rows, (row) => {
                    return row.id;
                });

                axios.delete(tools.url('/api/admin/materials'), { data: params })
                    .then((response) => {
                        this.$parent.showMessage(response.data.msg, "success");
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
        },

        pacakgeName(index, row) {
            return row.package?.name
        }
    },
    mounted() {
        this.mounthTable();
    }
}
</script>
  