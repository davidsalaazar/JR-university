package service;

import dao.DAO;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import modelo.AlumnoModelo;
import modelo.CarreraModelo;

/**
 * @author David Salazar Mejia
 * @correo davidsm54@gmail.com
 * @fecha 10/07/2018
 * @hora 06:21:12 PM
 * @encoding UTF-8
 * @empresa SOMA
 * @version 1.0
 */
public class AlumnoService {

    private AlumnoModelo alumno = null;

    private List<AlumnoModelo> lAlumno = null;

    private DAO dao = new DAO();

    public List<AlumnoModelo> buscaAlumno() {
        List<Object> lObjeto = dao.busca(AlumnoModelo.class, null, null);

        lAlumno = new ArrayList();

        for (Object object : lObjeto) {
            lAlumno.add((AlumnoModelo) object);
        }
        return lAlumno;
    }

    public AlumnoModelo buscaAlumno(AlumnoModelo alumno) {
        List<String> lCondicion = new ArrayList();
        List<Object> lValor = new ArrayList();

        lCondicion.add("appPaterno");
        lCondicion.add("appMaterno");
        lCondicion.add("nombreAlumno");
        lCondicion.add("sexo");
        lCondicion.add("carrera.idCarrera");

        lValor.add(alumno.getAppPaterno());
        lValor.add(alumno.getAppMaterno());
        lValor.add(alumno.getNombreAlumno());
        lValor.add(alumno.getSexo());
        lValor.add(alumno.getCarrera().getIdCarrera());

        List<Object> lObjeto = dao.busca(AlumnoModelo.class, lCondicion.toArray(), lValor.toArray());

        for (Object object : lObjeto) {
            alumno = (AlumnoModelo) object;
        }

        return alumno;
    }

    public List<AlumnoModelo> buscaAlumnoPorCarrera(String nombreCarrera) {
        List<Object> lCondicion = new ArrayList();
        List<Object> lValor = new ArrayList();

        CarreraModelo carrera = new CarreraService().buscaCarreraPorNombre(nombreCarrera);

        lAlumno = new ArrayList();

        if (carrera != null) {
            lCondicion.add("carrera.idCarrera");
            lValor.add(carrera.getIdCarrera());

            List<Object> lObjeto = dao.busca(AlumnoModelo.class, lCondicion.toArray(), lValor.toArray());

            for (Object object : lObjeto) {
                lAlumno.add((AlumnoModelo) object);
            }
        }

        return lAlumno;
    }

    public boolean agregaAlumno(List<AlumnoModelo> lAlumno) {
        List<Object> lObjeto = new ArrayList();

        for (AlumnoModelo alumno : lAlumno) {
            lObjeto.add(alumno);
        }

        if (!lObjeto.isEmpty()) {
            return dao.insertUpdate(lObjeto);
        }
        return false;
    }

    public boolean eliminaAlumno(List<AlumnoModelo> lAlumno) {
        List<Object> lObjeto = new ArrayList();

        for (AlumnoModelo alumno : lAlumno) {
            lObjeto.add(alumno);
        }

        if (!lObjeto.isEmpty()) {
            return dao.delete(lObjeto);
        }
        return false;
    }

    public static void main(String[] args) {
        List<Object> lAlumno = new ArrayList();

        for (int i = 0; i < 5; i++) {
            AlumnoModelo a = new AlumnoModelo();

            a.setAppPaterno("SALAZAR" + i);
            a.setAppMaterno("MEJIA" + i);
            a.setNombreAlumno("DAVID" + i);
            a.setCuatrimestre(2 + i);
            a.setFechaNacimiento(new Date());
            a.setSexo('H');

            lAlumno.add(a);
        }
//
        new DAO().insertUpdate(lAlumno);
    }

}
