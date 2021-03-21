using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using TransformSearcher;

namespace TestingTransformSearcher
{
    class Program
    {
        static void Main(string[] args)
        {
            var tsearch = new Searcher();

            /**
  <xsl:variable name="_pathXmls">\\tvaapps01\Colmena\Notas\ADN40\Produccion\noticia\</xsl:variable>
  <xsl:variable name="_queryXpath">/*[Activo = 'true']</xsl:variable>
  <xsl:variable name="_orderBy">FechaPublicacion</xsl:variable>
  <xsl:variable name="_ordering">ASC</xsl:variable>
  <xsl:variable name="_top">20</xsl:variable>
             **/

            var stopwatch = new System.Diagnostics.Stopwatch();
            Console.WriteLine("Iniciando busqueda en {0}.\nHora: {1}", "mexico", DateTime.Now.ToString("h:mm:ss tt"));
            stopwatch.Start();

            
            var result = tsearch.Search(@"\\tvaapps01\Colmena\Notas\ADN40\Produccion\noticia\mexico", "/*[Activo = 'true']", "//FechaPublicacion", "DESC", 25);

            stopwatch.Stop();
            var elapsed_time = stopwatch.Elapsed.TotalSeconds;


            Console.WriteLine("Hora final: {0}", DateTime.Now.ToString("h:mm:ss tt"));
            Console.WriteLine("Tiempo transcurrido para la búsqueda: {0}", elapsed_time);
        }
    }
}
