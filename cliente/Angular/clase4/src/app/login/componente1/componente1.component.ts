import { Component } from '@angular/core';

interface Persona {
  nombre:string,
  edad:number;
}

@Component({
  selector: 'app-componente1',
  standalone: false,
  templateUrl: './componente1.component.html',
  styleUrl: './componente1.component.css'
})
export class Componente1Component {
  title:string = 'Componente1'
  lista:string[] = ['uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez']; 
  personas:Persona[]=[
    {nombre:'jose', edad:10},
    {nombre:'pedro', edad:20},
    {nombre:'luis', edad:30},
    {nombre:'manolo', edad:40},
  ]
}
