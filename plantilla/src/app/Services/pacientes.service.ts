import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { IPaciente } from '../Interfaces/ipaciente';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PacientesService {
  apiurl = 'http://localhost/examenP2/controllers/pacientes.controller.php?op=';
  constructor(private lector: HttpClient) {}

  buscar(texto: string): Observable<IPaciente> {
    const formData = new FormData();
    formData.append('texto', texto);
    return this.lector.post<IPaciente>(this.apiurl + 'uno', formData);
  }

  todos(): Observable<IPaciente[]> {
    return this.lector.get<IPaciente[]>(this.apiurl + 'todos');
  }
  uno(idpaciente: number): Observable<IPaciente> {
    const formData = new FormData();
    formData.append('idpaciente', idpaciente.toString());
    return this.lector.post<IPaciente>(this.apiurl + 'uno', formData);
  }
  eliminar(idpaciente: number): Observable<number> {
    const formData = new FormData();
    formData.append('idpaciente', idpaciente.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(pacientes: IPaciente): Observable<string> {
    const formData = new FormData();
    formData.append('Nombre', pacientes.nombre);
    formData.append('Apellido', pacientes.apellido);
    formData.append('Fecha_nacimiento', pacientes.fecha_nacimiento.toString());
    formData.append('Telefono', pacientes.telefono);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }
  actualizar(pacientes: IPaciente): Observable<string> {
    const formData = new FormData();
    formData.append('idpaciente', pacientes.idpaciente.toString());
    formData.append('Nombre', pacientes.nombre);
    formData.append('Apellido', pacientes.apellido);
    formData.append('Fecha_nacimiento', pacientes.fecha_nacimiento.toString());
    formData.append('Telefono', pacientes.telefono);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
