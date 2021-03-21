package examen;

import examen.Baul;

public class Cosas {

    private static Baul baul = new Baul();

    public static void main(String[] args){
        System.out.println("Cosas del baul");
        initialize();

        // Codigo feo :(
        System.out.println(baul.metal);
        System.out.println(baul.baul.metal);
        System.out.println(baul.baul.baul.metal);
        System.out.println(baul.baul.baul.baul.metal);
        System.out.println(baul.baul.baul.baul.baul.metal);
        // Fin del codigo feo.

        // TODO: Codifique aqui (llamar funcion recursiva)

    }

    // TODO: Funcion recursiva
    /*
     * Funcion recursiva que no existe aun
     */


    /*
     * Inicializa baul de cosas 
     */
    private static void initialize() {
        Baul cosas = new Baul();
        cosas.metal = "Aluminio";
        cosas.piedra = "Rubi";

        Baul cosas_hijo = new Baul();
        cosas_hijo.metal = "Oro";
        cosas_hijo.piedra = "Diamante";

        Baul cosas_nieto = new Baul();
        cosas_nieto.metal = "Plata";
        cosas_nieto.piedra = "Obsidiana";

        Baul cosas_bisnieto = new Baul();
        cosas_bisnieto.metal = "Cobre";
        cosas_bisnieto.piedra = "Carbon";

        Baul cosas_tataranieto = new Baul();
        cosas_tataranieto.metal = "Mercurio";
        cosas_tataranieto.piedra = "Zafiro";

        cosas_bisnieto.baul = cosas_tataranieto;
        cosas_nieto.baul = cosas_bisnieto;
        cosas_hijo.baul = cosas_nieto;
        cosas.baul = cosas_hijo;

        baul = cosas;
    }
}