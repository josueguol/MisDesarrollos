using System;

namespace RegisterADN40.Models.Entities
{
    public class Contact
    {
        public string Nombres { get; set; }

        public string Apellidos { get; set; }

        public string Correo { get; set; }

        public DateTime FechaRegistro { get; set; }
    }
}
