import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { IPaciente } from '../Interfaces/ipaciente';
import { PacientesService } from '../Services/pacientes.service';
import Swal from 'sweetalert2';
@Component({
  selector: 'app-pacientes',
  standalone: true,
  imports: [RouterLink, SharedModule],
  templateUrl: './pacientes.component.html',
  styleUrl: './pacientes.component.scss'
})
export class PacientesComponent {
  listapacientes: IPaciente[] = [];
  constructor(private PacientesServicio: PacientesService) {}

  ngOnInit() {
    this.cargatabla();
  }
  cargatabla() {
    this.PacientesServicio.todos().subscribe((data) => {
      console.log(data);
      this.listapacientes = data;
    });
  }
  eliminar(idpaciente) {
    Swal.fire({
      title: 'Pacientes',
      text: 'Esta seguro que desea eliminar el Paciente!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Emliminar Paciente'
    }).then((result) => {
      if (result.isConfirmed) {
        this.PacientesServicio.eliminar(idpaciente).subscribe((data) => {
          Swal.fire('Clientes', 'El cliente ha sido eliminado.', 'success');
          this.cargatabla();
        });
      }
    });
  }
}
