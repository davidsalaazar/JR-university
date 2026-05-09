package controlador;

import com.google.gson.Gson;
import com.google.gson.JsonArray;
import com.google.gson.JsonParser;
import java.io.IOException;
import java.io.PrintWriter;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelo.AlumnoModelo;
import modelo.CalificacionModelo;
import modelo.CarreraModelo;
import modelo.MateriaModelo;
import service.AlumnoService;
import service.CalificacionService;
import service.CarreraService;
import service.MateriaService;

/**
 * @author David Salazar Mejia
 * @correo davidsm54@gmail.com
 * @fecha 10/07/2018
 * @hora 06:21:57 PM
 * @encoding UTF-8
 * @empresa SOMA
 * @version 1.0
 */
@WebServlet(name = "controlador", urlPatterns = {"/controlador"})
public class Controlador extends HttpServlet {

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        //Set position on switch values
        int opcion = Integer.valueOf(request.getParameter("opcion"));

        //Set data from user
        String pJson = (String) request.getParameter("data");

        //Set data from a new User and score of math
        String pJson2 = (String) request.getParameter("data2");

        //Inicialize a new Parse Json
        JsonParser parser = new JsonParser();

        //Obtain Array from JSON
        JsonArray gsonArr = parser.parse(pJson).getAsJsonArray();

        //Instance to get acces to AlumnoService all method
        AlumnoService alumnoService = new AlumnoService();

        //Alumno List to save a list of alumnos
        List<AlumnoModelo> lAlumno = new ArrayList();

        CarreraModelo carrera = new CarreraService().buscaCarreraPorNombre(gsonArr.get(4).getAsString());

        Date fecha = new Date();

        try {
            fecha = new SimpleDateFormat("yyyy-MM-dd").parse(gsonArr.get(3).getAsString());
        } catch (Exception e) {
        }

        AlumnoModelo alumno = new AlumnoModelo();

        alumno.setAppPaterno(gsonArr.get(0).getAsString());
        alumno.setAppMaterno(gsonArr.get(1).getAsString());
        alumno.setNombreAlumno(gsonArr.get(2).getAsString());
        alumno.setFechaNacimiento(fecha);
        alumno.setCuatrimestre(1);
        alumno.setSexo('H');
        alumno.setCarrera(carrera);

        boolean estadoActual = false;

        String lCalificacionJSON = "";

        JsonArray gsonArr2 = null;

        switch (opcion) {
            //Guarda Alumno
            case 1:
                lAlumno.add(alumno);
                estadoActual = alumnoService.agregaAlumno(lAlumno);
                break;
            //Modifica Alumno
            case 2:
                AlumnoModelo alumnoN = alumnoService.buscaAlumno(alumno);

                gsonArr2 = parser.parse(pJson2).getAsJsonArray();

                CarreraModelo carreraN = new CarreraService().buscaCarreraPorNombre(gsonArr2.get(4).getAsString());

                //Set new Values to new ALUMNO
                alumnoN.setAppPaterno(gsonArr2.get(0).getAsString());
                alumnoN.setAppMaterno(gsonArr2.get(1).getAsString());
                alumnoN.setNombreAlumno(gsonArr2.get(2).getAsString());
                alumnoN.setCarrera(carreraN);

                lAlumno.add(alumnoN);

                estadoActual = alumnoService.agregaAlumno(lAlumno);
                break;
            //Elimina Alumno
            case 3:
                AlumnoModelo alumnoM = alumnoService.buscaAlumno(alumno);

                List<MateriaModelo> lMateriaEl = new MateriaService().buscaMateria();
                List<MateriaModelo> lMateriaAl = new ArrayList();

                for (MateriaModelo materia : lMateriaEl) {
                    if (materia.getCarrera().getIdCarrera() == alumnoM.getCarrera().getIdCarrera()) {
                        lMateriaAl.add(materia);
                    }
                }

                CalificacionService calificacionService = new CalificacionService();

                for (MateriaModelo materia : lMateriaAl) {
                    CalificacionModelo ca = new CalificacionModelo();
                    ca.setAlumno(alumnoM);
                    ca.setMateria(materia);

                    calificacionService.eliminaCalificacion(ca);
                }

                lAlumno.add(alumnoM);

                estadoActual = alumnoService.eliminaAlumno(lAlumno);
                break;
            //Ver Calificaciones
            case 4:
                calificacionService = new CalificacionService();

                List<Object> lObjeto = calificacionService.buscaCalificacionAlumno(alumno);

                Object[] aObje = (Object[]) lObjeto.get(0);

                if (aObje[0] == null) {
                    lObjeto = new ArrayList();
                }

                if (lObjeto != null && !lObjeto.isEmpty()) {
                    lCalificacionJSON = new Gson().toJson(lObjeto);
                } else {
                    List<MateriaModelo> lMateriaN = new ArrayList();

                    AlumnoModelo alumnoC = alumnoService.buscaAlumno(alumno);

                    List<MateriaModelo> lMateria = new MateriaService().buscaMateria();

                    for (MateriaModelo materia : lMateria) {
                        if (materia.getCarrera().getIdCarrera() == alumnoC.getCarrera().getIdCarrera()) {
                            lMateriaN.add(materia);
                        }
                    }
                    List<CalificacionModelo> lCalificacion = new ArrayList();

                    for (MateriaModelo materia : lMateriaN) {
                        CalificacionModelo calificacion = new CalificacionModelo();

                        calificacion.setAlumno(alumnoC);
                        calificacion.setAnio(2018);
                        calificacion.setCalificacion1(0);
                        calificacion.setCalificacion2(0);
                        calificacion.setCalificacion3(0);
                        calificacion.setCalificacion4(0);
                        calificacion.setCalificacionF(0);
                        calificacion.setPeriodo(1);
                        calificacion.setMateria(materia);
                        lCalificacion.add(calificacion);
                    }

                    calificacionService.agregaCalificacion(lCalificacion);

                    lObjeto = calificacionService.buscaCalificacionAlumno(alumnoC);
                }
                break;
            //Actualizar Calificaciones
            case 5:
                gsonArr2 = parser.parse(pJson2).getAsJsonArray();

                int calificacion = gsonArr2.get(0).getAsInt();
                int nCalificacion = gsonArr2.get(1).getAsInt();
                String nombreMateria = gsonArr2.get(2).getAsString();

                MateriaModelo materia = new MateriaService().buscaMateriaPorNombre(nombreMateria);

                calificacionService = new CalificacionService();

                alumnoN = alumnoService.buscaAlumno(alumno);

                CalificacionModelo calificacionM = calificacionService.buscaCalificacionAlumnoMateria(
                        alumnoN.getIdAlumno(), materia.getIdMateria());

                switch (nCalificacion) {
                    case 1:
                        calificacionM.setCalificacion1(calificacion);
                        break;
                    case 2:
                        calificacionM.setCalificacion2(calificacion);
                        break;
                    case 3:
                        calificacionM.setCalificacion3(calificacion);
                        break;
                    case 4:
                        calificacionM.setCalificacion4(calificacion);
                        break;
                }

                List<CalificacionModelo> lCalificacion = new ArrayList();
                lCalificacion.add(calificacionM);

                estadoActual = calificacionService.agregaCalificacion(lCalificacion);
                break;
        }

        PrintWriter out = response.getWriter();

        if (opcion == 4) {
            out.println(lCalificacionJSON);
        } else {
            out.println(estadoActual);
        }

        out.flush();
    }

}
