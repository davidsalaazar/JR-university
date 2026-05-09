package modelo;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.CascadeType;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.Temporal;

/**
 * @author David Salazar Mejia
 * @correo davidsm54@gmail.com
 * @fecha 10/07/2018
 * @hora 05:45:11 PM
 * @encoding UTF-8
 * @version 1.0
 */
@Entity
@Table(name = "alumno")
public class AlumnoModelo implements Serializable {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int idAlumno;

    private String nombreAlumno;
    private String appPaterno;
    private String appMaterno;
    private char sexo;

    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaNacimiento;

    private double promedioC1;

    private double promedioC2;

    private double promedioC3;

    private double promedioC4;

    private double promedioC5;

    private int cuatrimestre;

    @ManyToOne(cascade = CascadeType.MERGE)
    @JoinColumn(name = "ID_carrera")
    public CarreraModelo carrera;

    public int getIdAlumno() {
        return idAlumno;
    }

    public void setIdAlumno(int idAlumno) {
        this.idAlumno = idAlumno;
    }

    public String getNombreAlumno() {
        return nombreAlumno;
    }

    public void setNombreAlumno(String nombreAlumno) {
        this.nombreAlumno = nombreAlumno;
    }

    public String getAppPaterno() {
        return appPaterno;
    }

    public void setAppPaterno(String appPaterno) {
        this.appPaterno = appPaterno;
    }

    public String getAppMaterno() {
        return appMaterno;
    }

    public void setAppMaterno(String appMaterno) {
        this.appMaterno = appMaterno;
    }

    public char getSexo() {
        return sexo;
    }

    public void setSexo(char sexo) {
        this.sexo = sexo;
    }

    public Date getFechaNacimiento() {
        return fechaNacimiento;
    }

    public void setFechaNacimiento(Date fechaNacimiento) {
        this.fechaNacimiento = fechaNacimiento;
    }

    public double getPromedioC1() {
        return promedioC1;
    }

    public void setPromedioC1(double promedioC1) {
        this.promedioC1 = promedioC1;
    }

    public double getPromedioC2() {
        return promedioC2;
    }

    public void setPromedioC2(double promedioC2) {
        this.promedioC2 = promedioC2;
    }

    public double getPromedioC3() {
        return promedioC3;
    }

    public void setPromedioC3(double promedioC3) {
        this.promedioC3 = promedioC3;
    }

    public double getPromedioC4() {
        return promedioC4;
    }

    public void setPromedioC4(double promedioC4) {
        this.promedioC4 = promedioC4;
    }

    public double getPromedioC5() {
        return promedioC5;
    }

    public void setPromedioC5(double promedioC5) {
        this.promedioC5 = promedioC5;
    }

    public int getCuatrimestre() {
        return cuatrimestre;
    }

    public void setCuatrimestre(int cuatrimestre) {
        this.cuatrimestre = cuatrimestre;
    }

    public CarreraModelo getCarrera() {
        return carrera;
    }

    public void setCarrera(CarreraModelo carrera) {
        this.carrera = carrera;
    }

}//end Alumno
