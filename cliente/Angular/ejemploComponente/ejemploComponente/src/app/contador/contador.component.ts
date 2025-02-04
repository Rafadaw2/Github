import { Component } from '@angular/core';

@Component({
  selector: 'app-contador',
  standalone: false,
  
  templateUrl: './contador.component.html',
  styleUrl: './contador.component.css'
})
export class ContadorComponent {
  title:string = 'Ejemplo componente';
  contador:number = 20;
  incrementar(cant:number=1):void{
    this.contador+=cant;
  }
  decrementar(cant:number=1):void{
    this.contador-=cant;
  }
  
}
