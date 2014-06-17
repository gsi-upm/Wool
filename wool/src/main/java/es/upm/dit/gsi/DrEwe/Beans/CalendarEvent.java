package es.upm.dit.gsi.DrEwe.Beans;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.TimeZone;

import org.w3c.dom.DOMException;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;

public class CalendarEvent extends Event {
	private String title;
	private String [] attendees;
	private Calendar start;
	private Date droolsTimeStamp;
	private long droolsDuration;


	public CalendarEvent(String source, Calendar timeStamp, String title,
			String[] attendees, Calendar start) {
		super(source, timeStamp);
		this.title = title;
		this.attendees = attendees;
		this.start = start;
		//Set the drools TimeStamp 10 minutes earlier
		Calendar startCopy=start;
		startCopy.roll(Calendar.MINUTE, -10);
		this.droolsTimeStamp=start.getTime();
		
		this.droolsDuration=1200000;

	}


	public CalendarEvent(String source, Calendar timeStamp, String title,
			String[] attendees, Calendar start, Date droolsTimeStamp,
			long droolsDuration) {
		super(source, timeStamp);
		this.title = title;
		this.attendees = attendees;
		this.start = start;
		this.droolsTimeStamp = droolsTimeStamp;
		this.droolsDuration = droolsDuration;
	}


	public long getDroolsDuration() {
		return droolsDuration;
	}


	public void setDroolsDuration(long duration) {
		this.droolsDuration = duration;
	}


	public Date getDroolsTimeStamp() {
		return droolsTimeStamp;
	}


	public void setDroolsTimeStamp(Date droolsTimeStamp) {
		this.droolsTimeStamp = droolsTimeStamp;
	}


	public String getTitle() {
		return title;
	}


	public void setTitle(String title) {
		this.title = title;
	}


	public String[] getAttendees() {
		return attendees;
	}


	public void setAttendees(String[] attendees) {
		this.attendees = attendees;
	}


	public Calendar getStart() {
		return start;
	}


	public void setStart(Calendar start) {
		this.start = start;
	}




	public CalendarEvent(Node nNode){
		super("unknown", Calendar.getInstance(TimeZone.getTimeZone("UTC")));
		super.setSource("CalendarEvent");

		Element element=(Element)nNode;
		NodeList childs=element.getElementsByTagName("field");

		for (int temp = 0; temp < childs.getLength(); temp++) {
			Node subnode=childs.item(temp);
			Element subelement = (Element)subnode;
			String attname=subelement.getAttribute("name");
			if(attname.equals("TITLE")){
				this.title=subnode.getTextContent();
			}else if(attname.equals("ATTENDEES")){
				
				this.attendees=subnode.getTextContent().split("#");
			}else if(attname.equals("START")){
				Calendar calStart = Calendar.getInstance();
				SimpleDateFormat sdfStart = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss Z");
				try {
					
					String toDate=subnode.getTextContent();
					
					String [] splitted= toDate.split("\\+");
					String toParse=splitted[0]+" +"+splitted[1].replace(":", "");
					
					calStart.setTime(sdfStart.parse(toParse));
					this.start=calStart;
					
					Calendar startCopy=start;
					startCopy.roll(Calendar.MINUTE, -10);
					this.droolsTimeStamp=startCopy.getTime();
					this.droolsDuration=1200000;
				} catch (DOMException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				} catch (ParseException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}else if(attname.equals("timed")){
			

				Calendar cal = Calendar.getInstance();
				SimpleDateFormat sdf = new SimpleDateFormat("dd/MM/yyyy HH:mm:ss Z");
				try {
					cal.setTime(sdf.parse(subnode.getTextContent()));
					super.setTimeStamp(cal);

				} catch (DOMException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				} catch (ParseException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}

		}

	}
}
