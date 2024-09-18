import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormControl, FormGroup, ReactiveFormsModule, ValidationErrors, Validators } from '@angular/forms';
import { PacientesService } from 'src/app/Services/pacientes.service';
import { IPaciente } from 'src/app/Interfaces/ipaciente';
import { CommonModule } from '@angular/common';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';
@Component({
  selector: 'app-nuevopaciente',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './nuevopaciente.component.html',
  styleUrl: './nuevopaciente.component.scss'
})
export class NuevopacienteComponent implements OnInit {
  frm_Paciente = new FormGroup({
    //idpaciente: new FormControl(),

    nombre: new FormControl('', Validators.required),
    apellido: new FormControl('', Validators.required),
    fecha_nacimiento: new FormControl('', Validators.required),
    telefono: new FormControl('', Validators.required),
  });
  idpaciente = 0;
  titulo = 'Nuevo Paciente';
  constructor(
    private PasientesServicio: PacientesService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.idpaciente = parseInt(this.ruta.snapshot.paramMap.get('idpaciente'));
    if (this.idpaciente > 0) {
      this.PasientesServicio.uno(this.idpaciente).subscribe((unpaciente) => {
        this.frm_Paciente.controls['Nombre'].setValue(unpaciente.nombre);
        this.frm_Paciente.controls['Apellido'].setValue(unpaciente.apellido);
        this.frm_Paciente.controls['Fecha_nacimiento'].setValue(unpaciente.fecha_nacimiento);
        this.frm_Paciente.controls['Telefono'].setValue(unpaciente.telefono);

        this.titulo = 'Editar Paciente';
      });
    }
  }

  grabar() {
    let pacientes: IPaciente = {
      idpaciente: this.idpaciente,

      nombre: this.frm_Paciente.controls['Nombre'].value,
      apellido: this.frm_Paciente.controls['Apellido'].value,
      fecha_nacimiento: this.frm_Paciente.controls['Fecha_nacimiento'].value,
      telefono: this.frm_Paciente.controls['Telefono'].value,
      
    };

    Swal.fire({
      title: 'PACIENTE',
      text: 'Desea gurdar al Paciente ' + this.frm_Paciente.controls['Nombres'].value,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f00',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Grabar!'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idpaciente > 0) {
          this.PasientesServicio.actualizar(pacientes).subscribe((res: any) => {
            Swal.fire({
              title: 'Pasientes',
              text: res.mensaje,
              icon: 'success'
            });
            this.navegacion.navigate(['/pacientes']);
          });
        } else {
          this.PasientesServicio.insertar(pacientes).subscribe((res: any) => {
            Swal.fire({
              title: 'Clientes',
              text: res.mensaje,
              icon: 'success'
            });
            this.navegacion.navigate(['/clientes']);
          });
        }
      }
    });
  }

  validadorCedulaEcuador(control: AbstractControl): ValidationErrors | null {
    const cedula = control.value;
    if (!cedula) return null;
    if (cedula.length !== 10) return { cedulaInvalida: true };
    const provincia = parseInt(cedula.substring(0, 2), 10);
    if (provincia < 1 || provincia > 24) return { provincia: true };
    const tercerDigito = parseInt(cedula.substring(2, 3), 10);
    if (tercerDigito < 0 || tercerDigito > 5) return { cedulaInvalida: true };
    const digitoVerificador = parseInt(cedula.substring(9, 10), 10);
    const coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
    let suma = 0;
    for (let i = 0; i < coeficientes.length; i++) {
      const valor = parseInt(cedula.substring(i, i + 1), 10) * coeficientes[i];
      suma += valor > 9 ? valor - 9 : valor;
    }
    const resultado = suma % 10 === 0 ? 0 : 10 - (suma % 10);
    if (resultado !== digitoVerificador) return { cedulaInvalida: true };
    return null;
  }
}

