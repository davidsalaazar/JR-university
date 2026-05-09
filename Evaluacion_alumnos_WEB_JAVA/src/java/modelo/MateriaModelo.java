package modelo;

import java.io.Serializable;
import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;

/**
 * @author David Salazar Mejia
 * @correo davidsm54@gmail.com
 * @fecha 10/07/2018
 * @hora 05:45:11 PM
 * @encoding UTF-8
 * @version 1.0
 */
@Entity
@Table(name = "materia")
public class MateriaModelo implements Serializable {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idMateria;

    private int cuatrimestre;

    @Column(unique = true, nullable = false)
    private String nombreMateria;

    @ManyToOne(cascade = CascadeType.MERGE)
    @JoinColumn(name = "id_c")
    public CarreraModelo carrera;

    public int getIdMateria() {
        return idMateria;
    }

    public void setIdMateria(int idMateria) {
        this.idMateria = idMateria;
    }

    public int getCuatrimestre() {
        return cuatrimestre;
    }

    public void setCuatrimestre(int cuatrimestre) {
        this.cuatrimestre = cuatrimestre;
    }

    public String getNombreMateria() {
        return nombreMateria;
    }

    public void setNombreMateria(String nombreMateria) {
        this.nombreMateria = nombreMateria;
    }

    public CarreraModelo getCarrera() {
        return carrera;
    }

    public void setCarrera(CarreraModelo carrera) {
        this.carrera = carrera;
    }
}//end Materia
