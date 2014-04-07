<%
dim name, email
name = Request.Form("name")
email = Request.Form("email")
address = Request.Form("address")
sex = Request.Form("sex")
birthDate = Request.Form("birthDate")
jobSelect = Request.Form("jobSelect")
timeSelect = Request.Form("timeSelect")
picture = Request.Form("picture")
Response.Write("Name: " & name & "<br/>")
Response.Write("Email: " & email & "<br/>")
Response.Write("Address: " & address & "<br/>")
Response.Write("Sex: " & sex & "<br/>")
Response.Write("Birth Date: " & birthDate & "<br/>")
Response.Write("Job: " & jobSelect & "<br/>")
Response.Write("You want to pay for: " & timeSelect & "<br/>")
Response.Write("Your picture: " & picture & "<br/>")
%>