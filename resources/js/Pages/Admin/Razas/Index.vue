<template>
	<app-layout>
		<div class="col-12 mt-2">
			<div class="card">
				<div class="card-body">
					<h6 class="card-title text-dark text-gradient">Lista de Razas</h6>
					<div class="d-flex justify-content-end">
						<button type="button" class="btn btn-success" @click="openModal">
							<i class="fas fa-plus"></i> Registrar Raza
						</button>
					</div>
					<div class="toolbar">
						<!--        Here you can write extra buttons/actions for the toolbar              -->
					</div>
					<div class="table-responsive">
						<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%" ref="vuetable">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th class="disabled-sorting text-right">Acciones</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th class="text-right">Acciones</th>
								</tr>
							</tfoot>
						</table>
						<!-- end content-->
					</div>
					<!--  end card  -->
				</div>
				<!-- end col-md-12 -->
			</div>
		</div>
		<!-- Modal Create -->
		<modal-create :reload="reload" :showNotification="showNotification"></modal-create>
		<modal-edit :data="data" :reload="reload" :showNotification="showNotification"></modal-edit>
		<modal-confirm :data="data" :options="options" :reload="reload" :showNotification="showNotification"></modal-confirm>
	</app-layout>
</template>
<script>
import AppLayout from '@/Pages/Admin/Layouts/AppLayout'
import ModalCreate from '@/Pages/Admin/Razas/Create'
import ModalEdit from '@/Pages/Admin/Razas/Edit'
import ModalConfirm from '@/Pages/Admin/Partials/Confirm'

export default {
	components: {
		AppLayout,
		ModalCreate,
		ModalEdit,
		ModalConfirm
	},

	data() {
		return {
			data: [],
			options: {
				url: '',
				message: '',
				btnText: '',
				btnClass: '',
				iconClass: '',
				id: '',
				name: '',
			},
			table: null
		}
	},

	mounted(){
		this.datatables();
	},

	methods: {
		reload() {
			this.table.ajax.reload( null, false );
		},

		openModal() {
			var myModal = new bootstrap.Modal(document.getElementById('ModalCreate'), {
				keyboard: false
			});
			myModal.show();
		},

		edit(data) {
			axios.get(this.route('razas.edit', data.id_raz))
			.then(response => {
				this.data = response.data;
			})
			.catch(error => {
                console.log(error);
            })
			.then(response => {
				var myModal = new bootstrap.Modal(document.getElementById('ModalEdit'), {
					keyboard: false
				});
				myModal.show();
			});
		},

		destroy(data) {
			this.data = data;
			this.options.url = 'razas.destroy';
			this.options.message = 'Está seguro de eliminar la raza: ';
			this.options.btnText = 'Eliminar';
			this.options.btnClass = 'btn-danger bg-gradient-danger';
			this.options.iconClass = 'fa-ban text-danger';
			this.options.id = this.data.id_raz;
			this.options.name = this.data.nombre_raz;
			var myModal = new bootstrap.Modal(document.getElementById('ModalConfirm'), {
				keyboard: false
			});
			myModal.show();
		},

		showNotification: function(message, type) {
			$.notify({
				icon: "fas fa-check",
				message: message
			}, {
				type: type,
				timer: 3000,
				placement: {
					from: 'top',
					align: 'right',
				},
				onShow: function() {
					this.css({'width':'400px','height':'auto'});
				},
		    });
		},

		datatables() {
			this.$nextTick(() => {
				const self = this;
				self.table = $('#datatables').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "razas/list",
					"columns": [
					{data : 'id_raz'},
					{data : 'nombre_raz'},
					],
					"columnDefs": [
					{
						"targets": [2],
						"className": "text-right",
						"searchable": false,
						"orderable": false,
						"render": function(){
							var botones = '';

							botones = botones+'<button type="button" class="btn btn-icon-sm btn-secondary bg-gradient-secondary btn-icon-only rounded-circle mb-0 me-1 ms-1 edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar">'+
							'<span class="btn-inner--icon"><i class="fas fa-pen"></i></span>'+
							'</button>';

							botones = botones+'<button type="button" class="btn btn-icon-sm btn-danger bg-gradient-danger btn-icon-only rounded-circle mb-0 delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">'+
							'<span class="btn-inner--icon"><i class="fas fa-times"></i></span>'+
							'</button>';

							return botones;
						}
					}
					],
					"pagingType": "full_numbers",
					"lengthMenu": [
					[10, 25, 50, 100],
					[10, 25, 50, 100]
					],
					responsive: false,
					"language": {
						"lengthMenu": '_MENU_',
						"sSearch": '',
						"emptyTable": "Ningun dato disponible en esta tabla",
						"processing": "Procesando...",
						"sInfo": "Mostrando _TOTAL_ registros",
						"sSearchPlaceholder": "Buscar...",
						"zeroRecords": "No se encontraron resultados",
						"sInfoEmpty": "Mostrando 0 de 0 registros",
						"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
						"paginate": {
							"first": "Primera Página",
							"next": '<i class="fas fa-chevron-right"></i>',
							"previous": '<i class="fas fa-chevron-left"></i>',
							"last": "Última Página"
						}
					},
					"drawCallback": function( settings ) {
						var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
						var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
							return new bootstrap.Tooltip(tooltipTriggerEl)
						})
				    }
				});

				$('#datatables').on('click', '.edit, .restore, .delete', function (e) {
					e.preventDefault();
		            var data = self.table.row($(this).parents('tr')).data();

					if ($(this).hasClass('edit') == true) {
						self.edit(data);
		            } else if($(this).hasClass('restore') == true){
		            	self.restore(data);
		            } else {
		            	self.destroy(data);
		            }
		        });
			})
		}
	},
}
</script>