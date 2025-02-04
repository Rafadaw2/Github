import { Component } from '@angular/core';

@Component({
  selector: 'app-fother',
  standalone: false,
  
  templateUrl: './fother.component.html',
  styleUrl: './fother.component.css'
})
export class FotherComponent {
  title:string='Contacta';
  direccion:string='Calle Jaen 10';
  telefono:number=654879620;
  copy:string='@Copyright Todos los derechos reservados';

}
