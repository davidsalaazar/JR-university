package dao;

import hibernate.Hibernate;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.hibernate.Criteria;
import org.hibernate.Session;
import org.hibernate.Transaction;
import org.hibernate.criterion.Restrictions;

/**
 * @author David Salazar Mejia
 * @correo davidsm54@gmail.com
 * @fecha 10/07/2018
 * @hora 06:22:42 PM
 * @encoding UTF-8
 * @empresa SOMA
 * @version 1.0
 */
public class DAO {

    public boolean insertUpdate(List<Object> lObjeto) {
        boolean estadoActual = false;

        //Sesion para guardar la sesion de hibernate
        Session sesion = null;

        //Transaccion que se utilizara en la ejecucion del proceso
        Transaction transaccion = null;

        try {
            //Se abre la sesion de hibernate
            sesion = Hibernate.getSesion().openSession();

            //Se inicializa la transaccion
            transaccion = sesion.beginTransaction();

            for (Object object : lObjeto) {
                sesion.saveOrUpdate(object);
            }

            //Se confirmar que es correcta la transaccion
            transaccion.commit();

            estadoActual = true;
        } catch (Exception e) {
            Logger.getLogger(DAO.class.getName()).log(Level.SEVERE, null, e);
        }

        //Es necesario limpiar y cerrar la sesion antes de retornar
        if (sesion != null) {
            sesion.clear();
            sesion.close();
        }
        return estadoActual;
    }

    /**
     * Se encarga de extraer los datos de una tabla, con restricciones (WHERE)
     *
     * @param clase indica de donde se extraeran los datos
     * @param condicion indica el nombre de las columnas de comparacion de datos
     * @param valor indica los valores de las columnas
     * @return List Object[]
     */
    public List<Object> busca(Class clase, Object condicion[], Object valor[]) {
        //Sesion para guardar la sesion de hibernate
        Session session = null;

        //Transaccion que se utilizara en la ejecucion del proceso
        Transaction transaccion = null;

        //Lista de objetos que guardar el resultset
        List<Object> lObjeto = null;

        try {
            //Se abre la sesion de hibernate
            session = Hibernate.getSesion().openSession();

            //Inicializa la transaccion
            transaccion = session.beginTransaction();

            //Inicializa un objeto CRITERIA para  extraer los datos de las tablas
            Criteria criteria = session.createCriteria(clase);

            if (condicion != null && valor != null && condicion.length == valor.length && condicion.length > 0) {
                for (int i = 0; i < condicion.length; i++) {
                    criteria.add(Restrictions.eq(condicion[i].toString(), valor[i]));
                }
            }

            lObjeto = criteria.list();

            transaccion.commit();
        } catch (Exception e) {
            Logger.getLogger(DAO.class.getName()).log(Level.SEVERE, null, e);
        }

        //Es necesario limpiar y cerrar la sesion antes de retornar
        if (session != null) {
            session.clear();
            session.close();
        }

        return lObjeto;
    }

    public List<Object> busquedaEspecial(String consulta) {
        //Sesion para guardar la sesion de hibernate
        Session session = null;

        //Transaccion que se utilizara en la ejecucion del proceso
        Transaction transaccion = null;

        //Lista de objetos que guardar el resultset
        List<Object> lObjeto = new ArrayList();

        try {
            //Se abre la sesion de hibernate
            session = Hibernate.getSesion().openSession();

            //Inicializa la transaccion
            transaccion = session.beginTransaction();

            lObjeto = session.createSQLQuery(consulta).list();

            transaccion.commit();
        } catch (Exception e) {
            Logger.getLogger(DAO.class.getName()).log(Level.SEVERE, null, e);
        }

        //Es necesario limpiar y cerrar la sesion antes de retornar
        if (session != null) {
            session.clear();
            session.close();
        }

        return lObjeto;
    }

    public boolean delete(List<Object> lObjeto) {
        boolean estadoActual = false;

        //Sesion para guardar la sesion de hibernate
        Session sesion = null;

        //Transaccion que se utilizara en la ejecucion del proceso
        Transaction transaccion = null;

        try {
            //Se abre la sesion de hibernate
            sesion = Hibernate.getSesion().openSession();

            //Se inicializa la transaccion
            transaccion = sesion.beginTransaction();

            for (Object object : lObjeto) {
                sesion.delete(object);
            }

            //Se confirmar que es correcta la transaccion
            transaccion.commit();

            estadoActual = true;
        } catch (Exception e) {
            Logger.getLogger(DAO.class.getName()).log(Level.SEVERE, null, e);
        }

        //Es necesario limpiar y cerrar la sesion antes de retornar
        if (sesion != null) {
            sesion.clear();
            sesion.close();
        }
        return estadoActual;
    }
}
