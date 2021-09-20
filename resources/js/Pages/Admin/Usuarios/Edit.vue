<template>
	<div class="modal fade" id="ModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" ref="vuemodaledit">
		<div class="modal-dialog" role="document">
			<form @submit.prevent="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="ModalLabel">Modificar Usuario</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">×</span>
	 					</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group" :class="{ 'has-danger': errors.nombres_usuario }">
									<label for="e_nombres_usuario">Nombre</label>
									<input type="text" class="form-control" id="e_nombres_usuario" placeholder="Nombre del usuario" v-model="form.nombres_usuario" autofocus>
									<div v-if="errors.nombres_usuario">
										<small class="error text-danger">{{ errors.nombres_usuario[0] }}</small>
									</div>
								</div>
								<div class="form-group" :class="{ 'has-danger': errors.telefono_usuario }">
									<label for="telefono_usuario">Teléfono</label>
									<input type="text" class="form-control" id="telefono_usuario" placeholder="Teléfono del usuario" v-model="form.telefono_usuario">
									<div v-if="errors.telefono_usuario">
										<small class="error text-danger">{{ errors.telefono_usuario[0] }}</small>
									</div>
								</div>
								<div class="form-group" :class="{ 'has-danger': errors.direccion_usuario }">
									<label for="e_direccion_usuario">Dirección</label>
									<input type="text" class="form-control" id="e_direccion_usuario" placeholder="Dirección del usuario" v-model="form.direccion_usuario">
									<div v-if="errors.direccion_usuario">
										<small class="error text-danger">{{ errors.direccion_usuario[0] }}</small>
									</div>
								</div>
								<div class="form-group" :class="{ 'has-danger': errors.clave_usuario }">
									<label for="e_clave_usuario">Contraseña</label>
									<input type="password" class="form-control" id="e_clave_usuario" placeholder="Contraseña del usuario" v-model="form.clave_usuario">
									<div v-if="errors.clave_usuario">
										<small class="error text-danger">{{ errors.clave_usuario[0] }}</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group" :class="{ 'has-danger': errors.apellidos_usuario }">
									<label for="e_apellidos_usuario">Apellidos</label>
									<input type="text" class="form-control" id="e_apellidos_usuario" placeholder="Apellidos del usuario" v-model="form.apellidos_usuario">
									<div v-if="errors.apellidos_usuario">
										<small class="error text-danger">{{ errors.apellidos_usuario[0] }}</small>
									</div>
								</div>
								<div class="form-group" :class="{ 'has-danger': errors.correo_usuario }">
									<label for="e_correo_usuario">Correo Electrónico</label>
									<input type="email" class="form-control" id="e_correo_usuario" placeholder="Correo electrónico del usuario" v-model="form.correo_usuario">
									<div v-if="errors.correo_usuario">
										<small class="error text-danger">{{ errors.correo_usuario[0] }}</small>
									</div>
								</div>
								<div class="form-group">
									<label for="e_rol">Rol</label>
									<select class="form-control" id="e_rol" v-model="form.rol_usuario">
										<option disabled value="">Por favor seleccione un rol</option>
										<option>Administrador</option>
										<option>Gerente</option>
										<option>Capataz</option>
									</select>
									<div v-if="errors.rol_usuario">
										<small class="error text-danger">{{ errors.rol_usuario[0] }}</small>
									</div>
								</div>
								<div class="form-group">
									<label for="e_clave_usuario_confirmation">Confirmar contraseña</label>
									<input type="password" class="form-control" id="e_clave_usuario_confirmation" placeholder="Confirmar contraseña del usuario" v-model="form.clave_usuario_confirmation ">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-bs-dismiss="modal" :disabled="disabled">Cancelar</button>
						<button type="submit" class="btn btn-success" :disabled="disabled">
							<span v-if="disabled">
								<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
								Procesando
							</span>
							<span v-else>
								Guardar
							</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>
<script>
export default {
	props: ['data', 'reload', 'showNotification'],

	data() {
		return {
			usuario: [],
			form: {
				nombres_usuario: '',
				apellidos_usuario: '',
				direccion_usuario: '',
				correo_usuario: '',
				telefono_usuario: '',
				rol_usuario: '',
				clave_usuario: '',
				clave_usuario_confirmation: '',
			},
			errors: {},
			mensaje: '',
			disabled: false,
		}
	},

	mounted() {
		var ModalEditHidden = document.getElementById('ModalEdit')
		ModalEditHidden.addEventListener('hidden.bs.modal',this.clear);
		ModalEditHidden.addEventListener('show.bs.modal',this.fill);
	},

	methods: {
		async submit() {
			this.disabled = true;
			axios.put(this.route('usuarios.update', this.usuario.id), this.form)
			.then(response => {
				this.disabled = false;
				this.closeModal();
				this.reload();
				this.showNotification(response.data.message, response.data.type);
			})
			.catch(error => {
				this.disabled = false;
				if (error.response.data) {
					this.errors = error.response.data.errors;
				}
                if (error.response.status == 403) {
                    this.mensaje = 'Esta acción no está autorizada';
                    this.showNotification(this.mensaje, 'warning');
                    this.mensaje = '';
                }
            })
		},
		fill() {
			this.usuario = this.data;
			this.form.nombres_usuario = this.usuario.nombres_usuario;
			this.form.apellidos_usuario = this.usuario.apellidos_usuario;
			this.form.direccion_usuario = this.usuario.direccion_usuario;
			this.form.correo_usuario = this.usuario.correo_usuario;
			this.form.telefono_usuario = this.usuario.telefono_usuario;
			this.form.rol_usuario = this.usuario.rol_usuario;
		},
		clear() {
			this.errors = {};
			this.form.nombres_usuario = '';
			this.form.apellidos_usuario = '';
			this.form.direccion_usuario = '';
			this.form.correo_usuario = '';
			this.form.telefono_usuario = '';
			this.form.rol_usuario = '';
			this.form.clave_usuario = '';
			this.form.clave_usuario_confirmation = '';
		},
		closeModal() {
			var ModalEdit = document.getElementById('ModalEdit')
			var modal = bootstrap.Modal.getInstance(ModalEdit)
			modal.hide();
		}
	}
}
</script>