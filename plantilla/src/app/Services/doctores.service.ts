import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { IDoctores } from '../Interfaces/idoctores';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class DoctoresService {
  apiurl = 'http://localhost/examenP2/controllers/pacientes.controller.php?op=';
  constructor(private lector: HttpClient) {}

  buscar(texto: string): Observable<IDoctores> {
    const formData = new FormData();
    formData.append('texto', texto);
    return this.lector.post<IDoctores>(this.apiurl + 'uno', formData);
  }

  todos(): Observable<IDoctores[]> {
    return this.lector.get<IDoctores[]>(this.apiurl + 'todos');
  }
  uno(iddoctor: number): Observable<IDoctores> {
    const formData = new FormData();
    formData.append('iddoctores', iddoctor.toString());
    return this.lector.post<IDoctores>(this.apiurl + 'uno', formData);
  }
  eliminar(iddoctor: number): Observable<number> {
    const formData = new FormData();
    formData.append('idpaciente', iddoctor.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(doctores: IDoctores): Observable<string> {
    const formData = new FormData();
    formData.append('Nombre', doctores.nombre);
    formData.append('Apellido', doctores.apellido);
    formData.append('Especialidad', doctores.especialidad);
    formData.append('Telefono', doctores.telefono);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }
  actualizar(doctores: IDoctores): Observable<string> {
    const formData = new FormData();
    formData.append('Nombre', doctores.nombre);
    formData.append('Apellido', doctores.apellido);
    formData.append('Especialidad', doctores.especialidad);
    formData.append('Telefono', doctores.telefono);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
