
/** channels indexes **/
db.getCollection("channels").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** rules indexes **/
db.getCollection("rules").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** spaces indexes **/
db.getCollection("spaces").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** templates_spin indexes **/
db.getCollection("templates_spin").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** channels records **/
db.getCollection("channels").insert({
  "@context": {
    "dcterms": "http:\/\/purl.org\/dc\/terms\/",
    "ewe": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/",
    "foaf": "http:\/\/xmlns.com\/foaf\/0.1\/",
    "homepage": {
      "@id": "http:\/\/schema.org\/url",
      "@type": "@id"
    },
    "image": {
      "@id": "http:\/\/schema.org\/image",
      "@type": "@id"
    },
    "owl": "http:\/\/www.w3.org\/2002\/07\/owl#",
    "rdf": "http:\/\/www.w3.org\/1999\/02\/22-rdf-syntax-ns#",
    "rdfs": "http:\/\/www.w3.org\/2000\/01\/rdf-schema#",
    "spinrdf": "http:\/\/spinrdf.org\/sp#",
    "tags": "http:\/\/www.holygoat.co.uk\/owl\/redwood\/0.1\/tags\/",
    "xsd": "http:\/\/www.w3.org\/2001\/XMLSchema#"
  },
  "@graph": [
    {
      "@type": "ewe:Action",
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/GSIBot",
      "dcterms:description": "This Action will make the bot say Hello specifically to you.",
      "dcterms:title": "Say Hello!"
    },
    {
      "@id": "https:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/channel\/bot",
      "@type": "ewe:Channel",
      "space": "located\/lab_gsi",
      "ewe:hasAction": {
        "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/GSIBot"
      },
      "dcterms:description": "This bot has been developed by GSI UPM.",
      "dcterms:title": "GSI bot",
      "foaf:logo": "https:\/\/www.gsi.dit.upm.es\/templates\/jgsi\/images\/bot\/avatars\/happy.png"
    }
  ],
  "_id": ObjectId("5384d498c0af9748058b4567")
});
db.getCollection("channels").insert({
  "@context": {
    "dcterms": "http:\/\/purl.org\/dc\/terms\/",
    "ewe": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/",
    "foaf": "http:\/\/xmlns.com\/foaf\/0.1\/",
    "homepage": {
      "@id": "http:\/\/schema.org\/url",
      "@type": "@id"
    },
    "image": {
      "@id": "http:\/\/schema.org\/image",
      "@type": "@id"
    },
    "owl": "http:\/\/www.w3.org\/2002\/07\/owl#",
    "rdf": "http:\/\/www.w3.org\/1999\/02\/22-rdf-syntax-ns#",
    "rdfs": "http:\/\/www.w3.org\/2000\/01\/rdf-schema#",
    "spinrdf": "http:\/\/spinrdf.org\/sp#",
    "tags": "http:\/\/www.holygoat.co.uk\/owl\/redwood\/0.1\/tags\/",
    "xsd": "http:\/\/www.w3.org\/2001\/XMLSchema#"
  },
  "@graph": [
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/GSILight",
      "@type": "ewe:Event",
      "dcterms:description": "This Trigger checks if the lights at GSI Lab are on.",
      "dcterms:title": "Is on"
    },
    {
      "@id": "https:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/channel\/light",
      "@type": "ewe:Channel",
      "ewe:generatesEvent": {
        "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/GSILight"
      },
      "space": "located\/lab_gsi",
      "dcterms:description": "This channel represents the lights at the GSI-Lab.",
      "dcterms:title": "Light at GSI-Lab",
      "foaf:logo": "http:\/\/upload.wikimedia.org\/wikipedia\/commons\/2\/2d\/Logo_of_ceiling_light_for_brownout.png"
    }
  ],
  "_id": ObjectId("5384d4cdc0af97290b8b4567")
});
db.getCollection("channels").insert({
  "@context": {
    "dcterms": "http:\/\/purl.org\/dc\/terms\/",
    "ewe": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/",
    "foaf": "http:\/\/xmlns.com\/foaf\/0.1\/",
    "homepage": {
      "@id": "http:\/\/schema.org\/url",
      "@type": "@id"
    },
    "image": {
      "@id": "http:\/\/schema.org\/image",
      "@type": "@id"
    },
    "owl": "http:\/\/www.w3.org\/2002\/07\/owl#",
    "rdf": "http:\/\/www.w3.org\/1999\/02\/22-rdf-syntax-ns#",
    "rdfs": "http:\/\/www.w3.org\/2000\/01\/rdf-schema#",
    "spinrdf": "http:\/\/spinrdf.org\/sp#",
    "tags": "http:\/\/www.holygoat.co.uk\/owl\/redwood\/0.1\/tags\/",
    "xsd": "http:\/\/www.w3.org\/2001\/XMLSchema#"
  },
  "@graph": [
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/TV",
      "@type": "ewe:Action",
      "ewe:hasInputParameter": [
        {
          "@type": "ewe:InputParameter",
          "dcterms:title": "TV message",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        }
      ],
      "dcterms:description": "This action turns on the TV at the GSI lab and shows a message.",
      "dcterms:title": "Turn on the TV"
    },
    {
      "@id": "https:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/channel\/GSI_TV",
      "@type": "ewe:Channel",
      "space": "located\/lab_gsi",
      "ewe:hasAction": {
        "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/TV"
      },
      "dcterms:description": "The TV at the GSI lab.",
      "dcterms:title": "GSI TV",
      "foaf:logo": "http:\/\/static.ibnlive.in.com\/ibnlive\/pix\/sitepix\/11_2012\/benqtv-191112.jpg"
    }
  ],
  "_id": ObjectId("53ac47abc0af97fa1e8b4567")
});
db.getCollection("channels").insert({
  "@context": {
    "dcterms": "http:\/\/purl.org\/dc\/terms\/",
    "ewe": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/",
    "foaf": "http:\/\/xmlns.com\/foaf\/0.1\/",
    "homepage": {
      "@id": "http:\/\/schema.org\/url",
      "@type": "@id"
    },
    "image": {
      "@id": "http:\/\/schema.org\/image",
      "@type": "@id"
    },
    "owl": "http:\/\/www.w3.org\/2002\/07\/owl#",
    "rdf": "http:\/\/www.w3.org\/1999\/02\/22-rdf-syntax-ns#",
    "rdfs": "http:\/\/www.w3.org\/2000\/01\/rdf-schema#",
    "spinrdf": "http:\/\/spinrdf.org\/sp#",
    "tags": "http:\/\/www.holygoat.co.uk\/owl\/redwood\/0.1\/tags\/",
    "xsd": "http:\/\/www.w3.org\/2001\/XMLSchema#"
  },
  "@graph": [
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/SendMeAnSms",
      "@type": "ewe:Action",
      "ewe:hasInputParameter": [
        {
          "@type": "ewe:InputParameter",
          "dcterms:title": "SMS content",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        }
      ],
      "dcterms:description": "This action will send you a new SMS. It is not free.",
      "dcterms:title": "Send me a SMS"
    },
    {
      "@id": "https:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/channel\/SMS",
      "@type": "ewe:Channel",
      "space": "web_service",
      "ewe:hasAction": {
        "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/SendMeAnSms"
      },
      "dcterms:description": "SMS is a platform that enables the SMSs",
      "dcterms:title": "SMS",
      "foaf:logo": "https:\/\/d3rnbxvnd0hlox.cloudfront.net\/images\/channels\/5\/icons\/medium.png"
    }
  ],
  "_id": ObjectId("53a1b5d9c0af9753058b4568")
});
db.getCollection("channels").insert({
  "@context": {
    "dcterms": "http:\/\/purl.org\/dc\/terms\/",
    "ewe": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/",
    "foaf": "http:\/\/xmlns.com\/foaf\/0.1\/",
    "homepage": {
      "@id": "http:\/\/schema.org\/url",
      "@type": "@id"
    },
    "image": {
      "@id": "http:\/\/schema.org\/image",
      "@type": "@id"
    },
    "owl": "http:\/\/www.w3.org\/2002\/07\/owl#",
    "rdf": "http:\/\/www.w3.org\/1999\/02\/22-rdf-syntax-ns#",
    "rdfs": "http:\/\/www.w3.org\/2000\/01\/rdf-schema#",
    "spinrdf": "http:\/\/spinrdf.org\/sp#",
    "tags": "http:\/\/www.holygoat.co.uk\/owl\/redwood\/0.1\/tags\/",
    "xsd": "http:\/\/www.w3.org\/2001\/XMLSchema#"
  },
  "@graph": [
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Time",
      "@type": "ewe:Event",
      "ewe:hasOutputParameter": [
        {
          "@type": "ewe:outputParameter",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message",
          "dcterms:title": "Time"
        }
      ],
      "dcterms:description": "This event tells the time.",
      "dcterms:title": "Tells the time"
    },
    {
      "@id": "https:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/channel\/Clock",
      "@type": "ewe:Channel",
      "ewe:generatesEvent": {
        "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Time"
      },
      "space": "web_service",
      "dcterms:description": "Clock is a channel that communicates the time in Madrid, Spain.",
      "dcterms:title": "Clock",
      "foaf:logo": "https:\/\/d3rnbxvnd0hlox.cloudfront.net\/images\/channels\/3\/icons\/medium.png"
    }
  ],
  "_id": ObjectId("53a1b206c0af97441b8b4567")
});
db.getCollection("channels").insert({
  "@context": {
    "dcterms": "http:\/\/purl.org\/dc\/terms\/",
    "ewe": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/",
    "foaf": "http:\/\/xmlns.com\/foaf\/0.1\/",
    "homepage": {
      "@id": "http:\/\/schema.org\/url",
      "@type": "@id"
    },
    "image": {
      "@id": "http:\/\/schema.org\/image",
      "@type": "@id"
    },
    "owl": "http:\/\/www.w3.org\/2002\/07\/owl#",
    "rdf": "http:\/\/www.w3.org\/1999\/02\/22-rdf-syntax-ns#",
    "rdfs": "http:\/\/www.w3.org\/2000\/01\/rdf-schema#",
    "spinrdf": "http:\/\/spinrdf.org\/sp#",
    "tags": "http:\/\/www.holygoat.co.uk\/owl\/redwood\/0.1\/tags\/",
    "xsd": "http:\/\/www.w3.org\/2001\/XMLSchema#"
  },
  "@graph": [
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/NewStarredEmail",
      "@type": "ewe:Event",
      "ewe:hasOutputParameter": [
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/29b08556-ac73-11e2-a707-22000a9730cf",
          "dcterms:description": "A URL to the first file attachment (if any) that only you can see.",
          "dcterms:title": "FirstAttachmentPrivateURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Been having a good day so far...",
          "dcterms:description": "Plain text email body.",
          "dcterms:title": "BodyPlain",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "August 23, 2010 at 11:01PM",
          "dcterms:description": "Date and time email was received.",
          "dcterms:title": "ReceivedAt",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Hello there",
          "dcterms:description": "Email subject line.",
          "dcterms:title": "Subject",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "LadyTheDog.png",
          "dcterms:description": "The filename of the first file attachment (if any).",
          "dcterms:title": "FirstAttachmentFilename",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "somebody@gmail.com",
          "dcterms:description": "Email address of sender.",
          "dcterms:title": "FromAddress",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/4bfc930c-ac73-11e2-b086-22000a9730cf",
          "dcterms:description": "A URL to the first file attachment (if any) that anyone can see.",
          "dcterms:title": "FirstAttachmentPublicURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        }
      ],
      "dcterms:description": "This Trigger fires every time you add any new star to an email.",
      "dcterms:title": "New starred email"
    },
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/AnyNewEmail",
      "@type": "ewe:Event",
      "ewe:hasOutputParameter": [
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Been having a good day so far...",
          "dcterms:description": "Plain text email body.",
          "dcterms:title": "BodyPlain",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/4bfc930c-ac73-11e2-b086-22000a9730cf",
          "dcterms:description": "A URL to the first file attachment (if any) that anyone can see.",
          "dcterms:title": "FirstAttachmentPublicURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "somebody@gmail.com",
          "dcterms:description": "Email address of sender.",
          "dcterms:title": "FromAddress",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "August 23, 2010 at 11:01PM",
          "dcterms:description": "Date and time email was received.",
          "dcterms:title": "ReceivedAt",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "LadyTheDog.png",
          "dcterms:description": "The filename of the first file attachment (if any).",
          "dcterms:title": "FirstAttachmentFilename",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Hello there",
          "dcterms:description": "Email subject line.",
          "dcterms:title": "Subject",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/29b08556-ac73-11e2-a707-22000a9730cf",
          "dcterms:description": "A URL to the first file attachment (if any) that only you can see.",
          "dcterms:title": "FirstAttachmentPrivateURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        }
      ],
      "dcterms:description": "This Trigger fires every time any new email arrives in Gmail.",
      "dcterms:title": "Any new email"
    },
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/AnyNewAttachment",
      "@type": "ewe:Event",
      "ewe:hasOutputParameter": [
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "August 23, 2010 at 11:01PM",
          "dcterms:description": "Date and time email was received.",
          "dcterms:title": "ReceivedAt",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/4bfc930c-ac73-11e2-b086-22000a9730cf",
          "dcterms:description": "A URL to the file attachment that anyone can see.",
          "dcterms:title": "AttachmentPublicURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "somebody@gmail.com",
          "dcterms:description": "Email address of sender.",
          "dcterms:title": "FromAddress",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Hello there",
          "dcterms:description": "Email subject line.",
          "dcterms:title": "Subject",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Been having a good day so far...",
          "dcterms:description": "Plain text email body.",
          "dcterms:title": "BodyPlain",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "LadyTheDog.png",
          "dcterms:description": "The filename of the attachment.",
          "dcterms:title": "AttachmentFilename",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/29b08556-ac73-11e2-a707-22000a9730cf",
          "dcterms:description": "A URL to the file attachment that only you can see.",
          "dcterms:title": "AttachmentPrivateURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        }
      ],
      "dcterms:description": "This Trigger fires for every email attachment that arrives in your inbox.NOTE: Multiple attachments each fire separately.",
      "dcterms:title": "Any new attachment"
    },
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/SendAEmail",
      "@type": "ewe:Action",
      "ewe:hasInputParameter": [
        {
          "@type": "ewe:InputParameter",
          "dcterms:description": "some HTML ok",
          "dcterms:title": "Body",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:InputParameter",
          "dcterms:description": "URL to include as an attachment",
          "dcterms:title": "Attachment URL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:InputParameter",
          "dcterms:title": "Subject",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:InputParameter",
          "dcterms:description": "single email address only",
          "dcterms:title": "To address",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        }
      ],
      "dcterms:description": "This Action will send an email to a single recipient from your Gmail account.",
      "dcterms:title": "Send an email"
    },
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/NewEmailFrom",
      "@type": "ewe:Event",
      "ewe:hasInputParameter": {
        "@type": "ewe:InputParameter",
        "dcterms:title": "Email address",
        "xsd:type": "string_value"
      },
      "ewe:hasOutputParameter": [
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "somebody@gmail.com",
          "dcterms:description": "Email address of sender.",
          "dcterms:title": "FromAddress",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Hello there",
          "dcterms:description": "Email subject line.",
          "dcterms:title": "Subject",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Been having a good day so far...",
          "dcterms:description": "Plain text email body.",
          "dcterms:title": "BodyPlain",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "LadyTheDog.png",
          "dcterms:description": "The filename of the first file attachment (if any).",
          "dcterms:title": "FirstAttachmentFilename",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/4bfc930c-ac73-11e2-b086-22000a9730cf",
          "dcterms:description": "A URL to the first file attachment (if any) that anyone can see.",
          "dcterms:title": "FirstAttachmentPublicURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/29b08556-ac73-11e2-a707-22000a9730cf",
          "dcterms:description": "A URL to the first file attachment (if any) that only you can see.",
          "dcterms:title": "FirstAttachmentPrivateURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "August 23, 2010 at 11:01PM",
          "dcterms:description": "Date and time email was received.",
          "dcterms:title": "ReceivedAt",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        }
      ],
      "dcterms:description": "This Trigger fires every time a new email arrives in your inbox from the address you specify.",
      "dcterms:title": "New email from"
    },
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/NewEmailFromSearch",
      "@type": "ewe:Event",
      "ewe:hasInputParameter": {
        "@type": "ewe:InputParameter",
        "dcterms:title": "Search for",
        "xsd:type": "string_value"
      },
      "ewe:hasOutputParameter": [
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/29b08556-ac73-11e2-a707-22000a9730cf",
          "dcterms:description": "A URL to the first file attachment (if any) that only you can see.",
          "dcterms:title": "FirstAttachmentPrivateURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "somebody@gmail.com",
          "dcterms:description": "Email address of sender.",
          "dcterms:title": "FromAddress",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "August 23, 2010 at 11:01PM",
          "dcterms:description": "Date and time email was received.",
          "dcterms:title": "ReceivedAt",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "LadyTheDog.png",
          "dcterms:description": "The filename of the first file attachment (if any).",
          "dcterms:title": "FirstAttachmentFilename",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/4bfc930c-ac73-11e2-b086-22000a9730cf",
          "dcterms:description": "A URL to the first file attachment (if any) that anyone can see.",
          "dcterms:title": "FirstAttachmentPublicURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Hello there",
          "dcterms:description": "Email subject line.",
          "dcterms:title": "Subject",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Been having a good day so far...",
          "dcterms:description": "Plain text email body.",
          "dcterms:title": "BodyPlain",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        }
      ],
      "dcterms:description": "This Trigger fires every time a new email arrives in your inbox that matchesthe search query you specify.",
      "dcterms:title": "New email from search"
    },
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/NewEmailLabeled",
      "@type": "ewe:Event",
      "ewe:hasInputParameter": {
        "@type": "ewe:InputParameter",
        "dcterms:title": "Label",
        "xsd:type": "string_value"
      },
      "ewe:hasOutputParameter": [
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Hello there",
          "dcterms:description": "Email subject line.",
          "dcterms:title": "Subject",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "somebody@gmail.com",
          "dcterms:description": "Email address of sender.",
          "dcterms:title": "FromAddress",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/29b08556-ac73-11e2-a707-22000a9730cf",
          "dcterms:description": "A URL to the first file attachment (if any) that only you can see.",
          "dcterms:title": "FirstAttachmentPrivateURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "https:\/\/locker.ifttt.com\/f\/4bfc930c-ac73-11e2-b086-22000a9730cf",
          "dcterms:description": "A URL to the first file attachment (if any) that anyone can see.",
          "dcterms:title": "FirstAttachmentPublicURL",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Been having a good day so far...",
          "dcterms:description": "Plain text email body.",
          "dcterms:title": "BodyPlain",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "LadyTheDog.png",
          "dcterms:description": "The filename of the first file attachment (if any).",
          "dcterms:title": "FirstAttachmentFilename",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "Work",
          "dcterms:description": "The Gmail label from trigger.",
          "dcterms:title": "Label",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        },
        {
          "@type": "ewe:outputParameter",
          "ewe:example": "August 23, 2010 at 11:01PM",
          "dcterms:description": "Date and time email was received.",
          "dcterms:title": "ReceivedAt",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        }
      ],
      "dcterms:description": "This Trigger fires every time a new email arrives in your inbox with the labelyou specify.",
      "dcterms:title": "New email labeled"
    },
    {
      "@id": "https:\/\/ifttt.com\/gmail",
      "@type": "ewe:Channel",
      "space": "web_service",
      "ewe:generatesEvent": [
        {
          "@id": "https:\/\/ifttt.com\/channels\/gmail\/triggers\/86"
        },
        {
          "@id": "https:\/\/ifttt.com\/channels\/gmail\/triggers\/185"
        },
        {
          "@id": "https:\/\/ifttt.com\/channels\/gmail\/triggers\/85"
        },
        {
          "@id": "https:\/\/ifttt.com\/channels\/gmail\/triggers\/87"
        },
        {
          "@id": "https:\/\/ifttt.com\/channels\/gmail\/triggers\/186"
        },
        {
          "@id": "https:\/\/ifttt.com\/channels\/gmail\/triggers\/367"
        }
      ],
      "ewe:providesAction": {
        "@id": "https:\/\/ifttt.com\/channels\/gmail\/actions\/34"
      },
      "dcterms:description": "Googles approach to email, Gmail, is built on the idea that email can be more intuitive, efficient, and useful. And maybe even fun.",
      "dcterms:title": "Gmail",
      "foaf:logo": "https:\/\/ifttt.com\/images\/channels\/gmail_lrg.png",
      "foaf:url": "http:\/\/gmail.com"
    }
  ],
  "_id": ObjectId("533d7ab0c0af9786128b4567")
});
db.getCollection("channels").insert({
  "@context": {
    "dcterms": "http:\/\/purl.org\/dc\/terms\/",
    "ewe": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/",
    "foaf": "http:\/\/xmlns.com\/foaf\/0.1\/",
    "homepage": {
      "@id": "http:\/\/schema.org\/url",
      "@type": "@id"
    },
    "image": {
      "@id": "http:\/\/schema.org\/image",
      "@type": "@id"
    },
    "owl": "http:\/\/www.w3.org\/2002\/07\/owl#",
    "rdf": "http:\/\/www.w3.org\/1999\/02\/22-rdf-syntax-ns#",
    "rdfs": "http:\/\/www.w3.org\/2000\/01\/rdf-schema#",
    "spinrdf": "http:\/\/spinrdf.org\/sp#",
    "tags": "http:\/\/www.holygoat.co.uk\/owl\/redwood\/0.1\/tags\/",
    "xsd": "http:\/\/www.w3.org\/2001\/XMLSchema#"
  },
  "@graph": [
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/SendAChat",
      "@type": "ewe:Action",
      "ewe:hasInputParameter": [
        {
          "@type": "ewe:InputParameter",
          "dcterms:title": "Message",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message"
        }
      ],
      "dcterms:description": "This Action will send you a new chat message from the IFTTT chat bot (bot@ifttt.com).",
      "dcterms:title": "Send me a chat"
    },
    {
      "@id": "https:\/\/ifttt.com\/google_talk",
      "@type": "ewe:Channel",
      "space": "web_service",
      "ewe:hasAction": {
        "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/SendAChat"
      },
      "dcterms:description": "Google Talk is an instant messaging and voice over Internet protocol (VoIP) client application offered by Google Inc. Currently the Google Talk Channel only supports instant messaging.",
      "dcterms:title": "Google Talk",
      "foaf:logo": "https:\/\/ifttt.com\/images\/channels\/google_talk_lrg.png"
    }
  ],
  "_id": ObjectId("533d750ec0af9716128b4567")
});
db.getCollection("channels").insert({
  "@context": {
    "dcterms": "http:\/\/purl.org\/dc\/terms\/",
    "ewe": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/",
    "foaf": "http:\/\/xmlns.com\/foaf\/0.1\/",
    "homepage": {
      "@id": "http:\/\/schema.org\/url",
      "@type": "@id"
    },
    "image": {
      "@id": "http:\/\/schema.org\/image",
      "@type": "@id"
    },
    "owl": "http:\/\/www.w3.org\/2002\/07\/owl#",
    "rdf": "http:\/\/www.w3.org\/1999\/02\/22-rdf-syntax-ns#",
    "rdfs": "http:\/\/www.w3.org\/2000\/01\/rdf-schema#",
    "spinrdf": "http:\/\/spinrdf.org\/sp#",
    "tags": "http:\/\/www.holygoat.co.uk\/owl\/redwood\/0.1\/tags\/",
    "xsd": "http:\/\/www.w3.org\/2001\/XMLSchema#"
  },
  "@graph": [
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/eDNI",
      "@type": "ewe:Event",
      "dcterms:description": "This event is activated when a eDNI is introduced.",
      "dcterms:title": "DNI introduced",
      "ewe:hasOutputParameter": [
        {
          "@type": "ewe:outputParameter",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message",
          "dcterms:title": "DNI number"
        }
      ]
    },
    {
      "@id": "https:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/channel\/eDNI",
      "@type": "ewe:Channel",
      "ewe:generatesEvent": {
        "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/eDNI"
      },
      "space": "located\/lab_gsi",
      "dcterms:description": "This channel represent the eDNI reader at the GSI lab.",
      "dcterms:title": "eDNI",
      "foaf:logo": "http:\/\/www.casinos.es\/sites\/casinos.portalesmunicipales.es\/files\/images\/logo-dni-electronico.jpg"
    }
  ],
  "_id": ObjectId("53ac45e9c0af97f11e8b4567")
});
db.getCollection("channels").insert({
  "@context": {
    "dcterms": "http:\/\/purl.org\/dc\/terms\/",
    "ewe": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/",
    "foaf": "http:\/\/xmlns.com\/foaf\/0.1\/",
    "homepage": {
      "@id": "http:\/\/schema.org\/url",
      "@type": "@id"
    },
    "image": {
      "@id": "http:\/\/schema.org\/image",
      "@type": "@id"
    },
    "owl": "http:\/\/www.w3.org\/2002\/07\/owl#",
    "rdf": "http:\/\/www.w3.org\/1999\/02\/22-rdf-syntax-ns#",
    "rdfs": "http:\/\/www.w3.org\/2000\/01\/rdf-schema#",
    "spinrdf": "http:\/\/spinrdf.org\/sp#",
    "tags": "http:\/\/www.holygoat.co.uk\/owl\/redwood\/0.1\/tags\/",
    "xsd": "http:\/\/www.w3.org\/2001\/XMLSchema#"
  },
  "@graph": [
    {
      "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/NewFollower",
      "@type": "ewe:Event",
      "dcterms:description": "This event runs out when a now follower starts fololwing you.",
      "dcterms:title": "New Follower",
      "ewe:hasOutputParameter": [
        {
          "@type": "ewe:outputParameter",
          "ewe:Property": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/Message",
          "dcterms:title": "New Follower name"
        }
      ]
    },
    {
      "@id": "https:\/\/gsi.dit.upm.es\/ontologies\/ewe\/ns\/channel\/Twitter",
      "@type": "ewe:Channel",
      "ewe:generatesEvent": {
        "@id": "http:\/\/gsi.dit.upm.es\/ontologies\/ewe\/channels\/ns\/NewFollower"
      },
      "space": "web_service",
      "dcterms:description": "This is the Twitter channel.",
      "dcterms:title": "Twitter",
      "foaf:logo": "https:\/\/g.twimg.com\/Twitter_logo_blue.png"
    }
  ],
  "_id": ObjectId("53ad4fdec0af97f7118b4567")
});

/** rules records **/

/** spaces records **/
db.getCollection("spaces").insert({
  "_id": ObjectId("53908f0cc0af979d138b4567"),
  "number_spaces": 3,
  "spaces": [
    "web_service",
    "located\/lab_gsi",
    "located\/home"
  ]
});

/** templates_spin records **/
db.getCollection("templates_spin").insert({
  "_id": ObjectId("53676f55c0af97790df8a8e7"),
  "number_parameters": 1,
  "spin": "CONSTRUCT {\n    ?action a <?actionURI> .\n ?action <?actionParam1URI> ?actionParam1 .\n}\nWHERE {\n    ?event a <?eventURI> .\n  ?event <?eventParam1URI> ?eventParam1 .\n  BIND ( URI(\"?actionID\") as ?action )\n BIND( fn:concat(?eventParam1, \"\") AS ?actionParam1 )\n}"
});
db.getCollection("templates_spin").insert({
  "_id": ObjectId("53679693c0af97b50cf8a8e7"),
  "number_parameters": 2,
  "spin": "CONSTRUCT {\n    ?action a <?actionURI> .\n \t?action <?actionParam1URI> ?actionParam1 .\n \t?action <?actionParam2URI> ?actionParam2 .\n}\nWHERE {\n    ?event a <?eventURI> .\n  \t?event <?eventParam1URI> ?eventParam1 .\n  \t?event <?eventParam2URI> ?eventParam2 .\n  \tBIND ( URI(\"?actionID\") as ?action )\n \tBIND( fn:concat(?eventParam1, \"\") AS ?actionParam1 )\n \tBIND( fn:concat(?eventParam2, \"\") AS ?actionParam2 )\n}"
});
db.getCollection("templates_spin").insert({
  "_id": ObjectId("536796c7c0af97b70cf8a8e7"),
  "number_parameters": 3,
  "spin": "CONSTRUCT {\n    ?action a <?actionURI> .\n \t?action <?actionParam1URI> ?actionParam1 .\n \t?action <?actionParam2URI> ?actionParam2 .\n \t?action <?actionParam3URI> ?actionParam3 .\n}\nWHERE {\n    ?event a <?eventURI> .\n  \t?event <?eventParam1URI> ?eventParam1 .\n  \t?event <?eventParam2URI> ?eventParam2 .\n  \t?event <?eventParam3URI> ?eventParam3 .\n  \tBIND ( URI(\"?actionID\") as ?action )\n \tBIND( fn:concat(?eventParam1, \"\") AS ?actionParam1 )\n \tBIND( fn:concat(?eventParam2, \"\") AS ?actionParam2 )\n \tBIND( fn:concat(?eventParam3, \"\") AS ?actionParam3 )\n}\n"
});
db.getCollection("templates_spin").insert({
  "_id": ObjectId("5385fdbdc0af97dc0e8b4567"),
  "number_parameters": 0,
  "spin": "CONSTRUCT {\n    ?action a <?actionURI> .\n}\nWHERE {\n    ?event a <?eventURI> .\n    BIND ( URI(\"?actionID\") as ?action )\n}"
});
