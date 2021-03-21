using System;

namespace Trendings.Models
{
    public class View
    {
        public int Id { get; set; }

        public int IdNoticia {get; set; }

        public int IdBusqueda { get; set; }

        public string Token { get; set; }

        public string Link { get; set; }

        public string FechaVisita { get; set; }
    }
}