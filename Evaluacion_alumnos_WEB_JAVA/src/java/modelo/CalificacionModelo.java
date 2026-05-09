package modelo;

import java.io.Serializable;
import javax.persistence.CascadeType;
import javax.persistence.Entity;
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
@Table(name = "calificacion")
public class CalificacionModelo implements Serializable {

    @Id
    @ManyToOne(cascade = CascadeType.MERGE)
    @JoinColumn(name = "ID_M")
    public MateriaModelo materia;

    @Id
    @ManyToOne(cascade = CascadeType.MERGE)
    @JoinColumn(name = "Id_A")
    public AlumnoModelo alumno;

    private int anio;

    private int calificacion1;

    private int calificacion2;

    private int calificacion3;

    private int calificacion4;

    private int calificacionF;

    private int periodo;

    public MateriaModelo getMateria() {
        return materia;
    }

    public void setMateria(MateriaModelo materia) {
        this.materia = materia;
    }

    public AlumnoModelo getAlumno() {
        return alumno;
    }

    public void setAlumno(AlumnoModelo alumno) {
        this.alumno = alumno;
    }

    public int getAnio() {
        return anio;
    }

    public void setAnio(int anio) {
        this.anio = anio;
    }

    public int getCalificacion1() {
        return calificacion1;
    }

    public void setCalificacion1(int calificacion1) {
        this.calificacion1 = calificacion1;
    }

    public int getCalificacion2() {
        return calificacion2;
    }

    public void setCalificacion2(int calificacion2) {
        this.calificacion2 = calificacion2;
    }

    public int getCalificacion3() {
        return calificacion3;
    }

    public void setCalificacion3(int calificacion3) {
        this.calificacion3 = calificacion3;
    }

    public int getCalificacion4() {
        return calificacion4;
    }

    public void setCalificacion4(int calificacion4) {
        this.calificacion4 = calificacion4;
    }

    public int getCalificacionF() {
        return calificacionF;
    }

    public void setCalificacionF(int calificacionF) {
        this.calificacionF = calificacionF;
    }

    public int getPeriodo() {
        return periodo;
    }

    public void setPeriodo(int periodo) {
        this.periodo = periodo;
    }

}//end Calificacion
