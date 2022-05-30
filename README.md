## Planteamiento del problema y solución.

Primeramente, se procede a evaluar lo que se requiere y entender los requerimientos propuestos. 

![ConsultaPorZipcode-Page-2 drawio](https://user-images.githubusercontent.com/43276376/171057718-a947df00-930e-43f4-a828-30d7f65f45a4.png)


Luego, porocedí a evaluar el excel con los datos y compararlos con la api que se debia replicar para asi poder entener como se manejarian dichos datos.
Luego se procede a crear el diagrama de base de datos con sus entidades, atributos y como se relacionan estos entre si. 

![zipcodes_diagram](https://user-images.githubusercontent.com/43276376/171058401-ca6d2c0e-8e32-4fc3-8ccd-45659844a551.png)

Luego, realice un algoritmo para la lectura,inserción y manejo de datos desde un archivo excel hacia la base de datos según sus relaciones.

Entonces, una vez teniendo los datos, se procede a crear el algoritmo para el desarrollo del endpoint con el contrato definido.

La lógica del endpoint realiza validaciones si es un ID inválido o no lo encuentra muestra diferentes mensajes segun sea el caso. 