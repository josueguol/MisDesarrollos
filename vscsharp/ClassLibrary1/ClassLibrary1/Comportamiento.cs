using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ClassLibrary1
{
    abstract class Comportamiento
    {

        public void Evanza(){
            //TODO
        }
        public void Retrocede() { 
            //TODO
        }
        public void Derecha() { }
        public void Izquierda() { }

        abstract void Abajo();
    }
}
