using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ClassLibrary1
{
    public class Control
    {
        private IAlgo _obj;
        private Comportamiento _comp;

        void Control()
        {
            //TODO: evaluar y cargar interfaz
            _obj = (IAlgo)new Volar();  //Es mejor con reflexión
        }

        void Control()
        {
            _comp = (Comportamiento)new Volar();
        }

        void Action()
        {
            _obj.Evanza();
        }

        void ActionA()
        {
            _comp.Evanza();
        }
    }
}
