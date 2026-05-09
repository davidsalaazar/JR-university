package service;

import dao.DAO;
import java.util.ArrayList;
import java.util.List;
import modelo.AlumnoModelo;
import modelo.CalificacionModelo;
import modelo.CarreraModelo;

/**
 * @author David Salazar Mejia
 * @correo davidsm54@gmail.com
 * @fecha 10/07/2018
 * @hora 06:21:20 PM
 * @encoding UTF-8
 * @empresa SOMA
 * @version 1.0
 */
public class CalificacionService {

    private static List<CalificacionModelo> lCalificacion = null;

    private DAO dao = new DAO();

    public List<Object> buscaCalificacionAlumno(AlumnoModelo alumno) {
        String consulta = "select m.nombreMateria, ca.calificacion1, ca.calificacion2, \n"
                + "	ca.calificacion3, ca.calificacion4, ca.calificacionF,\n"
                + "	ca.periodo, ca.anio\n"
                + "                from materia m \n"
                + "	join calificacion ca on ca.ID_M = m.idMateria\n"
                + "	right join alumno a on ca.Id_A = a.idAlumno\n"
                + "		where a.ID_carrera = " + alumno.getCarrera().getIdCarrera() + "\n"
                + "			and a.nombreAlumno = '" + alumno.getNombreAlumno() + "' \n"
                + "			and a.appPaterno = '" + alumno.getAppPaterno() + "' \n"
                + "			and a.appMaterno = '" + alumno.getAppMaterno() + "' \n"
                + "	group BY m.nombreMateria,  ca.calificacion1, ca.calificacion2, \n"
                + "		ca.calificacion3, ca.calificacion4, ca.calificacionF,\n"
                + "		ca.periodo, ca.anio";

        return dao.busquedaEspecial(consulta);
    }

    public CalificacionModelo buscaCalificacionAlumnoMateria(int idAlumno, int idMateria) {
        List<String> lCondicion = new ArrayList();
        List<Object> lValor = new ArrayList();

        if (idAlumno > 0) {
            lCondicion.add("alumno.idAlumno");
            lValor.add(idAlumno);
        }

        if (idMateria > 0) {
            lCondicion.add("materia.idMateria");
            lValor.add(idMateria);
        }

        CalificacionModelo calificacion = null;

        List<Object> lObjeto = dao.busca(CalificacionModelo.class, lCondicion.toArray(), lValor.toArray());

        for (Object object : lObjeto) {
            calificacion = (CalificacionModelo) object;
        }
        return calificacion;
    }

    public boolean agregaCalificacion(List<CalificacionModelo> lCalificacion) {
        List<Object> lObjeto = new ArrayList();

        for (CalificacionModelo calificacion : lCalificacion) {
            double cFinal = 0.0;

            if (calificacion.getCalificacion1() > 7 && calificacion.getCalificacion2() > 7
                    && calificacion.getCalificacion3() > 7 && calificacion.getCalificacion4() > 7) {
                cFinal = calificacion.getCalificacion1() + calificacion.getCalificacion2()
                        + calificacion.getCalificacion3() + calificacion.getCalificacion4();
                
                cFinal = cFinal / 4;
                
                String cFInalS = String.valueOf(cFinal);
                
                int indiceDecimal = cFInalS.indexOf(".");
                
                String cFinalDe= cFInalS.substring(indiceDecimal + 1, 3);
                String cFinalEn = cFInalS.substring(0, indiceDecimal);
                
                if(Integer.parseInt(cFinalDe) > 4){
                    cFinalEn = String.valueOf(Integer.parseInt(cFinalEn) + 1);
                }                

                //Set the last score to leave the math
                calificacion.setCalificacionF(Integer.valueOf(cFinalEn));
            } else {
                //Set the last score to leave the math
                calificacion.setCalificacionF(0);
            }
            lObjeto.add(calificacion);
        }

        if (!lObjeto.isEmpty()) {
            return dao.insertUpdate(lObjeto);
        }
        return false;
    }

    public boolean eliminaCalificacion(CalificacionModelo calificacion) {
        List<Object> lObjeto = new ArrayList();

        lObjeto.add(calificacion);

        return dao.delete(lObjeto);
    }

    public static void main(String[] args) {
//        List<Object> lObjeto = new ArrayList<>();
//
//        for (int i = 0; i < 1; i++) {
//            CalificacionModelo ca = new CalificacionModelo();
//
//            AlumnoModelo a = new AlumnoModelo();
//            a.setIdAlumno(1);
//
//            MateriaModelo m = new MateriaModelo();
//            m.setIdMateria(1);
//
//            ca.setAlumno(a);
//            ca.setMateria(m);
//            ca.setCalificacion1(10);
//            ca.setCalificacion2(10);
//            ca.setCalificacion3(1);
//            ca.setCalificacion4(6);
//            ca.setCalificacionF(10);
//            ca.setPeriodo(1);
//
//            lObjeto.add(ca);
//        }
//
//        new DAO().insertUpdate(lObjeto);

        AlumnoModelo alu = new AlumnoModelo();

        CarreraModelo ca = new CarreraModelo();
        ca.setIdCarrer(1);

        alu.setAppPaterno("SALAZAR0");
        alu.setAppMaterno("MEJIA0");
        alu.setNombreAlumno("DAVID0");
        alu.setSexo('H');
        alu.setCarrera(ca);

        AlumnoModelo a = new AlumnoService().buscaAlumno(alu);

        new CalificacionService().buscaCalificacionAlumno(a);
    }

}
